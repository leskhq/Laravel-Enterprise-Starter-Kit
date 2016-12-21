<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\Route\RoutesByMethodAscending;
use App\Repositories\Criteria\Route\RoutesByPathAscending;
use App\Repositories\Criteria\Route\RoutesWhereNameOrPathOrActionNameLike;
use App\Repositories\Criteria\Route\RoutesWithPermissions;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\RouteRepository as Route;
use Auth;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class RoutesController extends Controller
{

    /**
     * @var Route
     */
    private $route;

    /**
     * @var Permission
     */
    private $permission;

    /**
     * @param Application $app
     * @param Audit $audit
     * @param Route $route
     * @param Permission $permission
     */
    public function __construct(Application $app, Audit $audit, Route $route, Permission $permission)
    {
        parent::__construct($app, $audit);
        $this->route = $route;
        $this->permission = $permission;
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'routes']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        //TODO: Warn of any routes in our DB that is not used in the app.

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-index'));

        $page_title = trans('admin/routes/general.page.index.title');
        $page_description = trans('admin/routes/general.page.index.description');

        $routes = $this->route->pushCriteria(new RoutesWithPermissions())
                              ->pushCriteria(new RoutesByPathAscending())
                              ->pushCriteria(new RoutesByMethodAscending())
                              ->paginate(20);
        $perms = $this->permission->all()->lists('display_name', 'id');
        // SR [2016-03-20] Cannot add/prepend a blank item as it reshuffles the array index.
        // This cause the permission to not be recognized by the code building the view and
        // matching permission with each route. From now on un-setting the permission of a
        // few is unsupported by design.
//        $perms = $perms->toArray(0);
//        array_unshift($perms, '');

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-show', ['name' => $route->name]));

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
        $this->validate($request, array(    'name'          => 'required|unique:routes',
                                            'action_name'   => 'required',
                                            'method'        => 'required',
                                            'path'          => 'required'
        ));

        $attributes = $request->all();

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-store', ['name' => $attributes['name']]));

        $this->route->create($attributes);

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-edit', ['name' => $route->name]));

        return view('admin.routes.edit', compact('route', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(    'name'          => 'required|unique:routes,name,' . $id,
                                            'action_name'   => 'required',
                                            'method'        => 'required',
                                            'path'          => 'required'
        ));

        $route = $this->route->find($id);

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-update', ['name' => $route->name]));

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-destroy', ['name' => $route->name]));

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

        $modal_route = route('admin.routes.delete', array('id' => $route->id));

        $modal_body = trans('admin/routes/dialog.delete-confirm.body', ['id' => $route->id, 'name' => $route->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $route = $this->route->find($id);

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-enable', ['name' => $route->name]));

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-disabled', ['name' => $route->name]));

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
        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-load'));

        $nbRoutesLoaded = \App\Models\Route::loadLaravelRoutes('/.*/');
        $nbRoutesDeleted = \App\Models\Route::deleteLaravelRoutes();

        Flash::success( trans('admin/routes/general.status.synced', ['nbLoaded' => $nbRoutesLoaded, 'nbDeleted' => $nbRoutesDeleted]) );
        return redirect('/admin/routes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function savePerms(Request $request)
    {
        $AuditAtt = $request->all();

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-save-perms'), $AuditAtt);

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-enabled-selected'), $chkRoute);

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

        Audit::log(Auth::user()->id, trans('admin/routes/general.audit-log.category'), trans('admin/routes/general.audit-log.msg-disabled-selected'), $chkRoute);

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

    /**
     * @param Request $request
     * @return array|static[]
     */
    public function searchByName(Request $request)
    {
        $return_arr = null;

        $query = $request->input('query');

        $routes = $this->route->pushCriteria(new RoutesWhereNameOrPathOrActionNameLike($query))->all();

        foreach ($routes as $route) {
            $id = $route->id;
            $method = $route->method;
            $path = $route->path;
            $name = $route->name;
            $action_name = $route->action_name;

            $entry_arr = [ 'id' => $id, 'text' => "$method $path ($name) [$action_name]"];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getInfo(Request $request)
    {
        $id = $request->input('id');
        $route = $this->route->find($id);

        return $route;
    }

}