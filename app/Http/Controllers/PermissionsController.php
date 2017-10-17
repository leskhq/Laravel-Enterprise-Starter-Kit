<?php

namespace App\Http\Controllers;

use App\Events\PermissionUpdatedRoles;
use App\Events\PermissionUpdatedRoutes;
use App\Events\PermissionUpdatedUsers;
use App\Events\PermissionUpdatingRoles;
use App\Events\PermissionUpdatingRoutes;
use App\Events\PermissionUpdatingUsers;
use App\Http\Requests\PermissionEditRequest;
use App\Models\Permission;
use App\Repositories\Criteria\Roles\RolesByDisplayNamesAscending;
use App\Repositories\Criteria\Routes\RoutesByIDAscending;
use App\Repositories\Criteria\Users\UsersByUsernamesAscending;
use App\Repositories\RoleRepository;
use App\Repositories\RouteRepository;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;
use App\Validators\PermissionValidator;
use URL;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;


class PermissionsController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @var PermissionRepository
     */
    protected $permission;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @var RouteRepository
     */
    protected $route;

    /**
     * @var PermissionValidator
     */
    protected $validator;

    public function __construct(PermissionValidator $validator, UserRepository $userRepository, PermissionRepository $permissionRepository, RoleRepository $roleRepository, RouteRepository $routeRepository)
    {
        $this->validator    = $validator;
        $this->user         = $userRepository;
        $this->permission   = $permissionRepository;
        $this->role         = $roleRepository;
        $this->route        = $routeRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = DataFilter::source(Permission::with(['users', 'roles', 'routes']));
        $filter->text('srch','Search against permissions or their associated roles, users or routes')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->add('select', $this->getToggleCheckboxCell())->cell( function( $value, $row) {
            if ($row instanceof Permission) {
                $id = $row->id;
                $cellValue = "<input type='checkbox' name='chkPerm[]' id='" . $id . " 'value='" . $id . "' >";
            } else {
                $cellValue = "";
            }
            return $cellValue;
        });

        $grid->add('id','ID', true)->style("width:100px");

        if (Auth::user()->hasPermission('core.p.permissions.read')) {
            $grid->add('{{ link_to_route(\'admin.permissions.show\', $name, [$id], []) }}','Name', 'name');
        } else {
            $grid->add('name','Name', 'name');
        }

        if (Auth::user()->hasPermission('core.p.permissions.read')) {
            $grid->add('{{ link_to_route(\'admin.permissions.show\', $display_name, [$id], []) }}','Display Name', 'display_name');
        } else {
            $grid->add('display_name','Display name', 'display_name');
        }

        $grid->add('description','Description', false);
        $grid->add('{{ $routes->count() }}','Routes', false);
        $grid->add('{{ $roles->count() }}','Roles', false);
        $grid->add('{{ $users->count() }}','Users', false);
        $grid->add( '{!! App\Libraries\Utils::permissionActionslinks($id) !!}', 'Actions');

        $grid->orderBy('name','asc');
        $grid->paginate(10);

        $page_title = trans('admin/permissions/general.page.index.title');
        $page_description = trans('admin/permissions/general.page.index.description');

        return view('admin.permissions.index', compact('filter', 'grid', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $previousURL = URL::previous();

        $page_title = trans('admin/permissions/general.page.create.title'); // "Admin | Permissions | Create";
        $page_description = trans('admin/permissions/general.page.create.description'); // "Creating a new permissions";

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $roles = $this->role->pushCriteria(new RolesByDisplayNamesAscending())->all();
        $routes = $this->route->pushCriteria(new RoutesByIDAscending())->all();
        $perm = new \App\Models\Permission();

        return view('admin.permissions.create', compact('perm', 'routes', 'roles', 'users', 'page_title', 'page_description', 'previousURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            $previousURL = $attributes['redirects_to'];

            // Validate attributes.
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create basic permission
            $perm = $this->permission->create($attributes);

            // Save role.
            $this->saveRoles($perm, $attributes);
            // Save user assignment.
            $this->saveUsers($perm, $attributes);
            // Save route assignment.
            $this->saveRoutes($perm, $attributes);

            Flash::success(trans('admin/permissions/general.status.created'));

            return redirect($previousURL);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $previousURL = URL::previous();

        $perm = $this->permission->with(['roles', 'users', 'routes'])->find($id);

        $page_title = trans('admin/permissions/general.page.show.title');
        $page_description = trans('admin/permissions/general.page.show.description', ['name' => $perm->name]);

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $roles = $this->role->pushCriteria(new RolesByDisplayNamesAscending())->all();
        $routes = $this->route->pushCriteria(new RoutesByIDAscending())->all();

        return view('admin.permissions.show', compact('perm', 'page_title', 'page_description', 'roles', 'users', 'routes', 'previousURL'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionEditRequest $request, $id)
    {
        $previousURL = route('admin.roles.index');
        switch ($request->method()) {
            // GET is called from index page.
            case "GET":
                $previousURL = URL::previous();
                break;
            // POST is called from show page.
            case "POST":
                $attributes = $request->all();
                $previousURL = $attributes['redirects_to'];
                break;
        }

        $perm = $this->permission->find($id);

        $page_title = trans('admin/permissions/general.page.edit.title');
        $page_description = trans('admin/permissions/general.page.edit.description', ['name' => $perm->name]);

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $roles = $this->role->pushCriteria(new RolesByDisplayNamesAscending())->all();
        $routes = $this->route->pushCriteria(new RoutesByIDAscending())->all();

        return view('admin.permissions.edit', compact('perm', 'roles', 'routes', 'users', 'page_title', 'page_description', 'previousURL'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            // Validate attributes.
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $previousURL = $attributes['redirects_to'];

            $perm = $this->permission->find($id);

            // Save role.
            $this->saveRoles($perm, $attributes);
            // Save user assignment.
            $this->saveUsers($perm, $attributes);
            // Save route assignment.
            $this->saveRoutes($perm, $attributes);

            // Save all other attributes.
            $perm->update($attributes);

            Flash::success(trans('admin/permissions/general.status.updated'));

            return redirect($previousURL);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Delete Confirm
     *
     * @param   int   $id
     *
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error = null;

        $perm = $this->permission->find($id);

        if (!$perm->isdeletable()) {
            abort(403);
        }

        $modal_title = trans('admin/permissions/dialog.delete-confirm.title');

        $role = $this->permission->find($id);
        $modal_route = route('admin.permissions.delete', array('id' => $role->id));

        $modal_body = trans('admin/permissions/dialog.delete-confirm.body', ['id' => $perm->id, 'name' => $perm->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perm = $this->permission->find($id);

        if (!$perm->isdeletable()) {
            abort(403);
        }

        $this->permission->delete($id);

        Flash::success( trans('admin/permissions/general.status.deleted') ); // 'Permission successfully deleted');

        return redirect()->back()->with('message', 'Permission deleted.');
    }


    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $previousURL = URL::previous();

        $perm = $this->permission->find($id);

        $perm->enabled = true;
        $perm->save();

        Flash::success(trans('admin/permissions/general.status.enabled'));

        return redirect($previousURL);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        $previousURL = URL::previous();

        $perm = $this->permission->find($id);

        $perm->enabled = false;
        $perm->save();

        Flash::success(trans('admin/permissions/general.status.disabled'));

        return redirect($previousURL);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $previousURL = URL::previous();

        $chkPerm = $request->input('chkPerm');

        if (isset($chkPerm)) {
            foreach ($chkPerm as $perm_id) {
                $perm = $this->permission->find($perm_id);
                $perm->enabled = true;
                $perm->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-enabled'));
        } else {
            Flash::warning(trans('admin/permissions/general.status.no-permission-selected'));
        }
        return redirect($previousURL);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        $previousURL = URL::previous();

        $chkPerm = $request->input('chkPerm');

        if (isset($chkPerm)) {
            foreach ($chkPerm as $perm_id) {
                $perm = $this->permission->find($perm_id);
                $perm->enabled = false;
                $perm->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-disabled'));
        } else {
            Flash::warning(trans('admin/permissions/general.status.no-permission-selected'));
        }
        return redirect($previousURL);
    }


    private function getToggleCheckboxCell()
    {
        $cell = "<a class=\"btn\" href=\"#\" onclick=\"toggleCheckbox(); return false;\" title=\"". trans('general.button.toggle-select') ."\">
                                            <i class=\"fa fa-check-square-o\"></i>
                                        </a>";
        return $cell;
    }

    /**
     * @param Permission $perm
     * @param array $attributes
     */
    private function saveUsers(Permission $perm, array $attributes = [])
    {
        event(new PermissionUpdatingUsers($perm));

        if (array_key_exists('users', $attributes) && ($attributes['users'])) {
            $perm->users()->sync($attributes['users']);
        } else {
            $perm->users()->sync([]);
        }

        event(new PermissionUpdatedUsers($perm));
    }

    /**
     * @param Permission $perm
     * @param array $attributes
     */
    private function saveRoles(Permission $perm, array $attributes = [])
    {
        event(new PermissionUpdatingRoles($perm));

        if (array_key_exists('roles', $attributes) && ($attributes['roles'])) {
            $perm->roles()->sync($attributes['roles']);
        } else {
            $perm->roles()->sync([]);
        }

        event(new PermissionUpdatedRoles($perm));
    }

    /**
     * @param Permission $perm
     * @param array $attributes
     */
    private function saveRoutes(Permission $perm, array $attributes = [])
    {
        event(new PermissionUpdatingRoutes($perm));

        if (array_key_exists('routes', $attributes) && (is_array($attributes['routes'])) && ("" != $attributes['routes'][0])) {
            $this->clearRouteAssociation($perm);

            foreach ($attributes['routes'] as $id) {
                $route = \App\Models\Route::find($id);
                $perm->routes()->save($route);
            }
        } else {
            $this->clearRouteAssociation($perm);
        }

        event(new PermissionUpdatedRoutes($perm));
    }

    private function clearRouteAssociation(Permission $perm)
    {
        foreach ($perm->routes as $route) {
            $route->permission()->dissociate();
            $route->save();
        }
        $perm->save();
    }


}
