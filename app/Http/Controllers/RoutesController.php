<?php namespace App\Http\Controllers;

//use App\Models\Route;
use App\Repositories\RouteRepository as Route;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\Criteria\Route\RoutesWithPermissions;
use App\Repositories\Criteria\Route\RoutesByPathAscending;
use App\Repositories\Criteria\Route\RoutesByMethodAscending;

use Illuminate\Http\Request;
use App\Http\Requests;
use Flash;
use App\Libraries\Utils;
use DB;

class RoutesController extends Controller {

    /**
     * @var Route
     */
    private $route;

    /**
     * @var Permission
     */
    private $permission;

    /**
     * @param Route $route
     * @param Permission $permission
     */
    public function __construct(Route $route, Permission $permission)
    {
        $this->route = $route;
        $this->permission = $permission;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        //TODO: Warn of any routes in our DB that is not used in the app.

        $page_title = trans('admin/routes/general.page.index.title');
        $page_description = trans('admin/routes/general.page.index.description');

        $routes = $this->route->pushCriteria(new RoutesWithPermissions())
                                ->pushCriteria(new RoutesByPathAscending())
                                ->pushCriteria(new RoutesByMethodAscending())
                                ->paginate(20);
        $perms = $this->permission->all()->lists('display_name', 'id');
        $perms = $perms->toArray(0);
        array_unshift($perms, '');

        return view('admin.routes.index', compact('routes', 'perms', 'page_title', 'page_description'));


    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $page_title = trans('admin/routes/general.page.show.title'); // "Admin | Route | Show";
        $page_description = trans('admin/routes/general.page.show.description'); // "Displaying route";

        $route = $this->route->find($id);

        return view('admin.routes.show', compact('route', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page_title = trans('admin/routes/general.page.create.title'); // "Admin | Route | Create";
        $page_description = trans('admin/routes/general.page.create.description'); // "Creating a new route";

        return view('admin.routes.create', compact('page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, array('method' => 'required', 'path' => 'required', 'action_name' => 'required|unique:routes'));

        $this->route->create($request->all());

        Flash::success( trans('admin/routes/general.status.created') );

        return redirect('/admin/routes');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $page_title = trans('admin/routes/general.page.edit.title');
        $page_description = trans('admin/routes/general.page.edit.description');

        $route = $this->route->find($id);

        return view('admin.routes.edit', compact('route', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array('method' => 'required', 'path' => 'required', 'action_name' => 'required|unique:routes'));

        $route = $this->route->find($id);

        $route->update($request->all());

        Flash::success( trans('admin/routes/general.status.updated') );

        return redirect('/admin/routes');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $route = $this->route->find($id);

        $this->route->delete($id);

        Flash::success( trans('admin/routes/general.status.deleted') );

        return redirect('/admin/routes');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $error = null;

        $route = $this->route->find($id);

        $modal_title = trans('admin/routes/dialog.delete-confirm.title');
        $modal_cancel = trans('general.button.cancel');
        $modal_ok = trans('general.button.ok');

        $modal_route = route('admin.routes.delete', array('id' => $route->id));

        $modal_body = trans('admin/routes/dialog.delete-confirm.body', ['id' => $route->id, 'name' => $route->name]);

        return view('modal_confirmation', compact('error', 'modal_route',
            'modal_title', 'modal_body', 'modal_cancel', 'modal_ok'));

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $route = $this->route->find($id);
        $route->enabled = true;
        $route->save();

        Flash::success(trans('admin/routes/general.status.enabled'));

        return redirect('/admin/routes');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        $route = $this->route->find($id);
        $route->enabled = false;
        $route->save();

        Flash::success(trans('admin/routes/general.status.disabled'));

        return redirect('/admin/routes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function load()
    {
        $AppRoutes =  \Route::getRoutes();

        $cnt = 0;

        foreach ($AppRoutes as $appRoute)
        {
            $name = $appRoute->getName();
            $methods = $appRoute->getMethods();
            $path = $appRoute->getPath();
            $actionName = $appRoute->getActionName();

            if (    !str_contains($actionName, 'AuthController') &&
                    !str_contains($actionName, 'PasswordController') ) {
                foreach ($methods as $method) {
                    $route = null;

                    if ('HEAD' !== $method                     // Skip method 'HEAD' looks to be duplicated of 'GET'
                        && !starts_with($path, '_debugbar')
                    )   // Skip all DebugBar routes.
                    {
                        // TODO: Use Repository 'findWhere' when its fixed!!
                        //                    $route = $this->route->findWhere([
                        //                        'method'      => $method,
                        //                        'action_name' => $actionName,
                        //                    ])->first();
                        $route = \App\Models\Route::ofMethod($method)->ofActionName($actionName)->ofPath($path)->first();

                        if (!isset($route)) {
                            $cnt++;
                            $newRoute = $this->route->create([
                                'name' => $name,
                                'method' => $method,
                                'path' => $path,
                                'action_name' => $actionName,
                            ]);
                        }
                    }
                }
            }
        }

        Flash::success( trans('admin/routes/general.status.loaded', ['number' => $cnt]) );
        return redirect('/admin/routes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function savePerms(Request $request)
    {
        $chkRoute = $request->input('chkRoute');
        $globalPerm_id = $request->input('globalPerm');
        $perms = $request->input('perms');

        if (isset($chkRoute) && isset($globalPerm_id))
        {
            foreach ($chkRoute as $route_id)
            {
                $route = $this->route->find($route_id);
                $route->permission_id = $globalPerm_id;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.global-perms-assigned'));
        }
        elseif (isset($perms))
        {
            foreach ($perms as $route_id => $perm_id)
            {
                $route = $this->route->find($route_id);
                $route->permission_id = $perm_id;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.indiv-perms-assigned'));
        }
        else
        {
            Flash::warning(trans('admin/routes/general.status.no-permission-changed-detected'));
        }
        return redirect('/admin/routes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $chkRoute = $request->input('chkRoute');

        if (isset($chkRoute))
        {
            foreach ($chkRoute as $route_id)
            {
                $route = $this->route->find($route_id);
                $route->enabled = true;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.global-enabled'));
        }
        else
        {
            Flash::warning(trans('admin/routes/general.status.no-route-selected'));
        }
        return redirect('/admin/routes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        $chkRoute = $request->input('chkRoute');

        if (isset($chkRoute))
        {
            foreach ($chkRoute as $route_id)
            {
                $route = $this->route->find($route_id);
                $route->enabled = false;
                $route->save();
            }
            Flash::success(trans('admin/routes/general.status.global-disabled'));
        }
        else
        {
            Flash::warning(trans('admin/routes/general.status.no-route-selected'));
        }
        return redirect('/admin/routes');
    }

}