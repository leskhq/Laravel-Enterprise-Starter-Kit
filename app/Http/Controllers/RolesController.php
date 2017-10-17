<?php

namespace App\Http\Controllers;

use App\Events\RoleUpdatedPermissions;
use App\Events\RoleUpdatedUsers;
use App\Events\RoleUpdatingPermissions;
use App\Events\RoleUpdatingUsers;
use App\Http\Requests;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleEditRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Repositories\Criteria\Permissions\PermissionsByDisplayNamesAscending;
use App\Repositories\Criteria\Roles\RolesWhereDisplayNameOrDescriptionLike;
use App\Repositories\Criteria\Users\UsersByUsernamesAscending;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Validators\RoleValidator;
use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Settings;
use URL;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;


class RolesController extends Controller
{

    //TODO: Protect some roles (admin, users, etc) from actions like disable, change perm, etc.??

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
     * @var RoleValidator
     */
    protected $validator;

    public function __construct(RoleValidator $validator, UserRepository $userRepository, PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->validator    = $validator;
        $this->user         = $userRepository;
        $this->permission   = $permissionRepository;
        $this->role         = $roleRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = DataFilter::source(Role::with(['users', 'permissions']));
        $filter->text('srch','Search against roles or their associated permissions or users')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->add('select', $this->getToggleCheckboxCell())->cell( function( $value, $row) {
            if ($row instanceof Role){
                if (("core.r.admins" == $row->name) || ("core.r.users" == $row->name)) {
                    $cellValue = "";
                } else {
                    $id = $row->id;
                    $cellValue = "<input type='checkbox' name='chkRole[]' id='".$id." 'value='".$id."' >";
                }
            } else {
                $cellValue = "";
            }
            return $cellValue;
        });

        $grid->add('id','ID', true)->style("width:100px");

        if (Auth::user()->hasPermission('core.p.roles.read')) {
            $grid->add('{{ link_to_route(\'admin.roles.show\', $name, [$id], []) }}','Name', 'name');
        } else {
            $grid->add('name','Name', 'name');
        }

        if (Auth::user()->hasPermission('core.p.roles.read')) {
            $grid->add('{{ link_to_route(\'admin.roles.show\', $display_name, [$id], []) }}','Display Name', 'display_name');
        } else {
            $grid->add('display_name','Display name', 'display_name');
        }

        $grid->add('description','Description', false);
        $grid->add('{{ $permissions->count() }}','Permissions', false);
        $grid->add('{{ $users->count() }}','Users', false);
        $grid->add( '{!! App\Libraries\Utils::roleActionslinks($id) !!}', 'Actions');

        $grid->orderBy('name','asc');
        $grid->paginate(10);

        $page_title = trans('admin/roles/general.page.index.title');
        $page_description = trans('admin/roles/general.page.index.description');

        return view('admin.roles.index', compact('filter', 'grid', 'page_title', 'page_description'));

    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $previousURL = URL::previous();

        $page_title = trans('admin/roles/general.page.create.title'); // "Admin | Roles | Create";
        $page_description = trans('admin/roles/general.page.create.description'); // "Creating a new roles";

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $perms = $this->permission->pushCriteria(new PermissionsByDisplayNamesAscending())->all();
        $role = new \App\Models\Role();

        return view('admin.roles.create', compact('role', 'perms', 'users', 'page_title', 'page_description', 'previousURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            $previousURL = $attributes['redirects_to'];

            // Validate attributes.
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create basic role
            $role = $this->role->create($attributes);

            // Save permission(s).
            $this->savePermissions($role, $attributes);
            // Save user membership(s).
            $this->saveUsers($role, $attributes);

            Flash::success(trans('admin/roles/general.status.created'));

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

        $role = $this->role->with(['permissions', 'users'])->find($id);

        $page_title = trans('admin/roles/general.page.show.title');
        $page_description = trans('admin/roles/general.page.show.description', ['name' => $role->name]);

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $permissions = $this->permission->pushCriteria(new PermissionsByDisplayNamesAscending())->all();

        return view('admin.roles.show', compact('role', 'page_title', 'page_description', 'permissions', 'users', 'previousURL'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleEditRequest $request, $id)
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

        $role = $this->role->find($id);

        $page_title = trans('admin/roles/general.page.edit.title');
        $page_description = trans('admin/roles/general.page.edit.description', ['name' => $role->name]);

        $users = $this->user->pushCriteria(new UsersByUsernamesAscending())->all();
        $perms = $this->permission->pushCriteria(new PermissionsByDisplayNamesAscending())->all();

        return view('admin.roles.edit', compact('role', 'perms', 'users', 'page_title', 'page_description', 'previousURL'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            // Validate attributes.
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $previousURL = $attributes['redirects_to'];

            $role = $this->role->find($id);

            // Save permission(s).
            $this->savePermissions($role, $attributes);
            // Save user membership(s).
            $this->saveUsers($role, $attributes);

            // Save all other attributes.
            $role->update($attributes);

            Flash::success(trans('admin/roles/general.status.updated'));

            return redirect($previousURL);

        } catch (ValidatorException $e) {
            Flash::error(trans('admin/roles/general.status.role-update-failed', ['failure' => $e->getMessageBag()]));
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

        $role = $this->role->find($id);

        if (!$role->isdeletable()) {
            abort(403);
        }

        $modal_title = trans('admin/roles/dialog.delete-confirm.title');

        $role = $this->role->find($id);
        $modal_route = route('admin.roles.delete', array('id' => $role->id));

        $modal_body = trans('admin/roles/dialog.delete-confirm.body', ['id' => $role->id, 'name' => $role->name]);

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
        $role = $this->role->find($id);

        if (!$role->isdeletable()) {
            abort(403);
        }

        $this->role->delete($id);

        Flash::success( trans('admin/roles/general.status.deleted') ); // 'Role successfully deleted');

        return redirect()->back()->with('message', 'Role deleted.');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $previousURL = URL::previous();

        $role = $this->role->find($id);

        $role->enabled = true;
        $role->save();

        Flash::success(trans('admin/roles/general.status.enabled'));

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

        $role = $this->role->find($id);

        $role->enabled = false;
        $role->save();

        Flash::success(trans('admin/roles/general.status.disabled'));

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

        $chkRoles = $request->input('chkRole');

        if (isset($chkRoles)) {
            foreach ($chkRoles as $role_id) {
                $role = $this->role->find($role_id);
                $role->enabled = true;
                $role->save();
            }
            Flash::success(trans('admin/roles/general.status.global-enabled'));
        } else {
            Flash::warning(trans('admin/roles/general.status.no-role-selected'));
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

        $chkRoles = $request->input('chkRole');

        if (isset($chkRoles)) {
            foreach ($chkRoles as $role_id) {
                $role = $this->role->find($role_id);
                $role->enabled = false;
                $role->save();
            }
            Flash::success(trans('admin/roles/general.status.global-disabled'));
        } else {
            Flash::warning(trans('admin/roles/general.status.no-role-selected'));
        }
        return redirect($previousURL);
    }

    /**
     * @param Request $request
     *
     * @return array|static[]
     */
    public function searchByName(Request $request)
    {
        $return_arr = null;

        $query = $request->input('query');

        $roles = $this->role->pushCriteria(new RolesWhereDisplayNameOrDescriptionLike($query))->all();

        foreach ($roles as $role) {
            $id = $role->id;
            $display_name = $role->display_name;
            $description = $role->description;

            $entry_arr = [ 'id' => $id, 'text' => "$display_name ($description)"];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getInfo(Request $request)
    {
        $id = $request->input('id');
        $role = $this->role->find($id);

        return $role;
    }

    private function getToggleCheckboxCell()
    {
        $cell = "<a class=\"btn\" href=\"#\" onclick=\"toggleCheckbox(); return false;\" title=\"". trans('general.button.toggle-select') ."\">
                                            <i class=\"fa fa-check-square-o\"></i>
                                        </a>";
        return $cell;
    }

    /**
     * @param Role $role
     * @param array $attributes
     */
    private function savePermissions(Role $role, array $attributes = [])
    {
        event(new RoleUpdatingPermissions($role));

        if (array_key_exists('perms', $attributes) && ($attributes['perms'])) {
            $role->permissions()->sync($attributes['perms']);
        } else {
            $role->permissions()->sync([]);
        }

        event(new RoleUpdatedPermissions($role));
    }

    /**
     * @param Role $role
     * @param array $attributes
     */
    private function saveUsers(Role $role, array $attributes = [])
    {
        event(new RoleUpdatingUsers($role));

        if (array_key_exists('users', $attributes) && ($attributes['users'])) {
            $role->users()->sync($attributes['users']);
        } else {
            $role->users()->sync([]);
        }

        event(new RoleUpdatedUsers($role));
    }

}
