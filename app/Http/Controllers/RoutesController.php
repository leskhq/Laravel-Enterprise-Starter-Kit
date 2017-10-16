<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RouteCreateRequest;
use App\Http\Requests\RouteEditRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Models\Route;
use App\Repositories\Criteria\Permissions\PermissionsByDisplayNamesAscending;
use App\Repositories\PermissionRepository;
use App\Repositories\RouteRepository;
use App\Validators\RouteValidator;
use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Response;
use URL;
use View;
use Zofe\Rapyd\DataFilter\DataFilter;
use Zofe\Rapyd\DataGrid\DataGrid;


class RoutesController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $permission;

    /**
     * @var RouteRepository
     */
    protected $route;

    /**
     * @var RouteValidator
     */
    protected $validator;

    public function __construct(RouteValidator $validator, PermissionRepository $permissionRepository, RouteRepository $routeRepository)
    {
        $this->validator    = $validator;
        $this->permission   = $permissionRepository;
        $this->route        = $routeRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = DataFilter::source(Route::with(['permission']));
        $filter->text('srch','Search against routes or their associated permission')->scope('freesearch');
        $filter->build();

        $grid = DataGrid::source($filter);

        $grid->add('select', $this->getToggleCheckboxCell())->cell( function( $value, $row) {
            if ($row instanceof Route) {
                $id = $row->id;
                $cellValue = "<input type='checkbox' name='chkRoute[]' id='" . $id . " 'value='" . $id . "' >";
            } else {
                $cellValue = "";
            }
            return $cellValue;
        });

        $grid->add('{{ ($permission)? $permission->display_name : "" }}','Permission', false);

        if (Auth::user()->hasPermission('core.routes.read')) {
            $grid->add('{{ link_to_route(\'admin.routes.show\', $method, [$id], []) }}','Method', 'method');
        } else {
            $grid->add('method','Method', 'method');
        }

        if (Auth::user()->hasPermission('core.routes.read')) {
            $grid->add('{{ link_to_route(\'admin.routes.show\', $path, [$id], []) }}','Path', 'path');
        } else {
            $grid->add('path','Path', 'path');
        }

        if (Auth::user()->hasPermission('core.routes.read')) {
            $grid->add('{{ ($name) ? link_to_route(\'admin.routes.show\', $name, [$id], []) : "" }}','Name', 'name');
        } else {
            $grid->add('{{ ($name) ? $name : "" }}','Name', 'Name');
        }

        $grid->add( '{!! App\Libraries\Utils::routeActionslinks($id) !!}', 'Actions');

        $grid->orderBy('path','asc');
        $grid->paginate(20);

        $page_title = trans('admin/routes/general.page.index.title');
        $page_description = trans('admin/routes/general.page.index.description');

        return view('admin.routes.index', compact('filter', 'grid', 'page_title', 'page_description'));

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

        $perms = $this->permission->pushCriteria(new PermissionsByDisplayNamesAscending())->all();
        $route = new \App\Models\Route();

        return view('admin.routes.create', compact('route', 'perms', 'page_title', 'page_description', 'previousURL'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RouteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RouteCreateRequest $request)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            $previousURL = $attributes['redirects_to'];

            // Validate attributes.
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create basic route
            $role = $this->route->create($attributes);

            Flash::success(trans('admin/routes/general.status.created'));

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

        $route = $this->route->find($id);

        $page_title = trans('admin/routes/general.page.show.title');
        $page_description = trans('admin/routes/general.page.show.description', ['name' => $route->name]);

        return view('admin.routes.show', compact('route', 'page_title', 'page_description', 'previousURL'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RouteEditRequest $request, $id)
    {
        $previousURL = route('admin.routes.index');
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

        $route = $this->route->find($id);

        $page_title = trans('admin/routes/general.page.edit.title');
        $page_description = trans('admin/routes/general.page.edit.description', ['name' => $route->name]);

        return view('admin.routes.edit', compact('route', 'page_title', 'page_description', 'previousURL'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RouteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RouteUpdateRequest $request, $id)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            // Validate attributes.
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $previousURL = $attributes['redirects_to'];

            $route = $this->route->update($request->all(), $id);


            Flash::success(trans('admin/routes/general.status.updated'));

            return redirect($previousURL);

        } catch (ValidatorException $e) {
            Flash::error(trans('admin/routes/general.status.role-update-failed', ['failure' => $e->getMessageBag()]));
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

        $route = $this->route->find($id);

        $modal_title = trans('admin/routes/dialog.delete-confirm.title');

        $route = $this->route->find($id);
        $modal_route = route('admin.routes.delete', array('id' => $route->id));

        $modal_body = trans('admin/routes/dialog.delete-confirm.body', ['id' => $route->id, 'name' => $route->name]);

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
        $route = $this->route->find($id);

        $this->route->delete($id);

        Flash::success( trans('admin/routes/general.status.deleted') ); // 'Route successfully deleted');

        return redirect()->back()->with('message', 'Route deleted.');
    }


    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $previousURL = URL::previous();

        $route = $this->route->find($id);

        $route->enabled = true;
        $route->save();

        Flash::success(trans('admin/routes/general.status.enabled'));

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

        $route = $this->route->find($id);

        $route->enabled = false;
        $route->save();

        Flash::success(trans('admin/routes/general.status.disabled'));

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

        $chkRoutes = $request->input('chkRoute');

        if (isset($chkRoutes)) {
            foreach ($chkRoutes as $route_id) {
                $route = $this->route->find($route_id);
                $route->enabled = true;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.global-enabled'));
        } else {
            Flash::warning(trans('admin/routes/general.status.no-route-selected'));
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

        $chkRoutes = $request->input('chkRoute');

        if (isset($chkRoutes)) {
            foreach ($chkRoutes as $route_id) {
                $route = $this->route->find($route_id);
                $route->enabled = false;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.global-disabled'));
        } else {
            Flash::warning(trans('admin/routes/general.status.no-route-selected'));
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


}
