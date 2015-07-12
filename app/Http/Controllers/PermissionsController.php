<?php namespace App\Http\Controllers;

use App\Repositories\Criteria\Permission\PermissionsWithRoles;
use App\Repositories\Criteria\Permission\PermissionsWithRoutes;
use App\Repositories\Criteria\Permission\PermissionsByNamesAscending;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\RoleRepository as Role;
use App\Repositories\RouteRepository as Route;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PermissionsController extends Controller {

    private $role;
    private $permission;
    private $route;

    /**
     * @param Permission $permission
     * @param Role $role
     * @param Route $route
     */
    public function __construct(Permission $permission, Role $role, Route $route)
    {
        $this->permission = $permission;
        $this->role = $role;
        $this->route = $route;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //TODO: Warn of any permission in our DB that is not used (assigned to a route) in the app.

        $page_title = trans('admin/permissions/general.page.index.title');
        $page_description = trans('admin/permissions/general.page.index.description');

        $perms = $this->permission->pushCriteria(new PermissionsByNamesAscending())->paginate(20);
        return view('admin.permissions.index', compact('perms', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $page_title = trans('admin/permissions/general.page.show.title');
        $page_description = trans('admin/permissions/general.page.show.description');

        $perm = $this->permission->find($id);
        $permRoles = $perm->roles();
        $permRoutes = $perm->routes();

        return view('admin.permissions.show', compact('perm', 'permRoles', 'permRoutes', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page_title = trans('admin/permissions/general.page.create.title');
        $page_description = trans('admin/permissions/general.page.create.description');

        return view('admin.permissions.create', compact('perms', 'page_title', 'page_description'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, array('name' => 'required|unique:permissions', 'display_name' => 'required'));

        $this->permission->create($request->all());

        Flash::success( trans('admin/permissions/general.status.created') );

        return redirect('/admin/permissions');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //TODO: Protect 'basic-authenticated', 'guest-only', 'open-to-all'

        $page_title = trans('admin/permissions/general.page.edit.title');
        $page_description = trans('admin/permissions/general.page.edit.description');

        $permission = $this->permission->find($id);

        if(!$permission->isEditable())
        {
            abort(403);
        }

        return view('admin.permissions.edit', compact('permission', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        //TODO: Protect 'basic-authenticated', 'guest-only', 'open-to-all'

        $this->validate($request, array('name' => 'required', 'display_name' => 'required'));

        $permission = $this->permission->find($id);

        if(!$permission->isEditable())
        {
            abort(403);
        }

        $permission->update($request->all());

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

        if(!$permission->isDeletable())
        {
            abort(403);
        }

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

        if(!$permission->isDeletable())
        {
            abort(403);
        }

        $modal_title = trans('admin/permissions/dialog.delete-confirm.title');
        $modal_cancel = trans('general.button.cancel');
        $modal_ok = trans('general.button.ok');

        $modal_route = route('admin.permissions.delete', array('id' => $permission->id));

        $modal_body = trans('admin/permissions/dialog.delete-confirm.body', ['id' => $permission->id, 'name' => $permission->name]);

        return view('modal_confirmation', compact('error', 'modal_route',
            'modal_title', 'modal_body', 'modal_cancel', 'modal_ok'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function generate()
    {
        $routes = $this->route->all();

        $cnt = 0;
        foreach ($routes as $route)
        {
            $name           = $route->path . '!' . $route->method;
            if (null == $this->permission->findBy('name', $name))
            {
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

        if (isset($chkPerms))
        {
            foreach ($chkPerms as $perm_id)
            {
                $permission = $this->permission->find($perm_id);
                $permission->enabled = true;
                $permission->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-enabled'));
        }
        else
        {
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

        if (isset($chkPerms))
        {
            foreach ($chkPerms as $perm_id)
            {
                $permission = $this->permission->find($perm_id);
                $permission->enabled = false;
                $permission->save();
            }
            Flash::success(trans('admin/permissions/general.status.global-disabled'));
        }
        else
        {
            Flash::warning(trans('admin/permissions/general.status.no-perm-selected'));
        }
        return redirect('/admin/permissions');
    }

}