<?php namespace App\Http\Controllers;

use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\Permission\PermissionsByNamesAscending;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\RoleRepository as Role;
use App\Repositories\RouteRepository as Route;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PermissionsController extends Controller
{

    private $role;
    private $permission;
    private $route;

    /**
     * @param Permission $permission
     * @param Role $role
     * @param Route $route
     */
    public function __construct(Application $app, Audit $audit, Permission $permission, Role $role, Route $route)
    {
        parent::__construct($app, $audit);
        $this->permission = $permission;
        $this->role = $role;
        $this->route = $route;
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'permissions']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //TODO: Warn of any permission in our DB that is not used (assigned to a route) in the app.

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-index'));

        $page_title = trans('admin/permissions/general.page.index.title');
        $page_description = trans('admin/permissions/general.page.index.description');

        $perms = $this->permission->pushCriteria(new PermissionsByNamesAscending())->paginate(20);
        return view('admin.permissions.index', compact('perms', 'page_title', 'page_description'));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $perm = $this->permission->find($id);

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-show', ['name' => $perm->name]));

        $page_title = trans('admin/permissions/general.page.show.title');
        $page_description = trans('admin/permissions/general.page.show.description', ['name' => $perm->name]); // "Displaying permission";

        return view('admin.permissions.show', compact('perm', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page_title = trans('admin/permissions/general.page.create.title');
        $page_description = trans('admin/permissions/general.page.create.description');

        $perm = new \App\Models\Permission();

        return view('admin.permissions.create', compact('perm', 'page_title', 'page_description'));

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, array('name' => 'required|unique:permissions',
                                        'display_name' => 'required'));

        $attributes = $request->all();

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-store', ['name' => $attributes['name']]));

        if ( array_key_exists('selected_routes', $attributes) ) {
            $attributes['routes'] = explode(",", $attributes['selected_routes']);
        }
        if ( array_key_exists('selected_roles', $attributes) ) {
            $attributes['roles'] = explode(",", $attributes['selected_roles']);
        }

        $perm = $this->permission->create($attributes);
        $perm->assignRoutes($attributes);
        $perm->assignRoles($attributes);

        Flash::success( trans('admin/permissions/general.status.created') );

        return redirect('/admin/permissions');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //TODO: Protect 'basic-authenticated', 'guest-only', 'open-to-all'

        $perm = $this->permission->find($id);

        $page_title = trans('admin/permissions/general.page.edit.title');
        $page_description = trans('admin/permissions/general.page.edit.description', ['name' => $perm->name]); // "Editing permission";

        if(!$perm->isEditable()) {
            abort(403);
        }

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-edit', ['name' => $perm->name]));

        return view('admin.permissions.edit', compact('perm', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(    'name'          => 'required|unique:permissions,name,' . $id,
                                            'display_name'  => 'required',
        ));

        $perm = $this->permission->find($id);

        if(!$perm->isEditable()) {
            abort(403);
        }

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-update', ['name' => $perm->name]));

        $attributes = $request->all();
        if ( array_key_exists('selected_routes', $attributes) ) {
            $attributes['routes'] = explode(",", $attributes['selected_routes']);
        }
        if ( array_key_exists('selected_roles', $attributes) ) {
            $attributes['roles'] = explode(",", $attributes['selected_roles']);
        }

        $perm->update($request->all());
        $perm->assignRoutes($attributes);
        $perm->assignRoles($attributes);

        Flash::success( trans('admin/permissions/general.status.updated') );

        return redirect('/admin/permissions');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //TODO: Protect 'basic-authenticated', 'guest-only', 'open-to-all'

        $permission = $this->permission->find($id);

        if(!$permission->isDeletable()) {
            abort(403);
        }

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-destroy', ['name' => $permission->name]));

        $this->permission->delete($id);

        Flash::success( trans('admin/permissions/general.status.deleted') );

        return redirect('/admin/permissions');
    }

    /**
     * Delete Confirm
     *
     * @param   int   $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        //TODO: Protect 'basic-authenticated', 'guest-only', 'open-to-all'

        $error = null;

        $permission = $this->permission->find($id);

        if(!$permission->isDeletable()) {
            abort(403);
        }

        $modal_title = trans('admin/permissions/dialog.delete-confirm.title');

        $modal_route = route('admin.permissions.delete', array('id' => $permission->id));

        $modal_body = trans('admin/permissions/dialog.delete-confirm.body', ['id' => $permission->id, 'name' => $permission->name]);

        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function generate()
    {
        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-generate'));

        $routes = $this->route->all();

        $cnt = 0;
        foreach ($routes as $route) {
            $name           = $route->path . '!' . $route->method;
            if (null == $this->permission->findBy('name', $name)) {
                $this->permission->create( ['name' => $name,
                                            'display_name' => $name,
                                            'description' => 'Auto-generated from route: ' . $route->action_name]);
                $cnt = $cnt + 1;

            }
        }

        Flash::success( trans('admin/permissions/general.status.generated', ['number' => $cnt]) );
        return redirect('/admin/permissions');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $permission = $this->permission->find($id);

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-enable', ['name' => $permission->name]));

        $permission->enabled = true;
        $permission->save();

        Flash::success(trans('admin/permissions/general.status.enabled'));

        return redirect('/admin/permissions');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        //TODO: Should we protect 'basic-authenticated', 'guest-only', 'open-to-all'??

        $permission = $this->permission->find($id);

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-disabled', ['name' => $permission->name]));

        $permission->enabled = false;
        $permission->save();

        Flash::success(trans('admin/permissions/general.status.disabled'));

        return redirect('/admin/permissions');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $chkPerms = $request->input('chkPerm');

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-enabled-selected'), $chkPerms);

        if (isset($chkPerms)) {
            foreach ($chkPerms as $perm_id) {
                $permission = $this->permission->find($perm_id);
                $permission->enabled = true;
                $permission->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-enabled'));
        } else {
            Flash::warning(trans('admin/permissions/general.status.no-perm-selected'));
        }
        return redirect('/admin/permissions');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        //TODO: Should we protect 'basic-authenticated', 'guest-only', 'open-to-all'??

        $chkPerms = $request->input('chkPerm');

        Audit::log(Auth::user()->id, trans('admin/permissions/general.audit-log.category'), trans('admin/permissions/general.audit-log.msg-disabled-selected'), $chkPerms);

        if (isset($chkPerms)) {
            foreach ($chkPerms as $perm_id) {
                $permission = $this->permission->find($perm_id);
                $permission->enabled = false;
                $permission->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-disabled'));
        } else {
            Flash::warning(trans('admin/permissions/general.status.no-perm-selected'));
        }
        return redirect('/admin/permissions');
    }

}