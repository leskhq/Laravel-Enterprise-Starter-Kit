<?php namespace App\Http\Controllers;

use App\Repositories\Criteria\Role\RolesWithPermissions;
use App\Repositories\Criteria\Role\RolesByNamesAscending;
use App\Repositories\RoleRepository as Role;
use App\Repositories\PermissionRepository as Permission;
use Illuminate\Http\Request;
use Flash;

class RolesController extends Controller {

    /**
     * @var Role
     */
    private $role;

    /**
     * @var Permission
     */
    private $permission;

    /**
     * @param User $user
     * @param Role $role
     */
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $page_title = trans('admin/roles/general.page.index.title'); // "Admin | Roles";
        $page_description = trans('admin/roles/general.page.index.description'); // "List of roles";

        $roles = $this->role->pushCriteria(new RolesWithPermissions())->pushCriteria(new RolesByNamesAscending())->paginate(10);
        return view('admin.roles.index', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $page_title = trans('admin/roles/general.page.show.title'); // "Admin | Role | Show";
        $page_description = trans('admin/roles/general.page.show.description'); // "Displaying role";

        $role = $this->role->find($id);
        $perms = $this->permission->all();
        $rolePerms = $role->perms();

        return view('admin.roles.show', compact('role', 'perms', 'rolePerms', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page_title = trans('admin/roles/general.page.create.title'); // "Admin | Role | Create";
        $page_description = trans('admin/roles/general.page.create.description'); // "Creating a new role";

        $role = new \App\Models\Role();
        $perms = $this->permission->all();
        return view('admin.roles.create', compact('role', 'perms', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->validate($request, array('name' => 'required|unique:roles', 'display_name' => 'required'));

        $role = $this->role->create($request->all());

        $role->savePermissions($request->get('perms'));

        $role->forcePermission('basic-authenticated');

        Flash::success( trans('admin/roles/general.status.created') ); // 'Role successfully created');

        return redirect('/admin/roles');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $page_title = trans('admin/roles/general.page.edit.title'); // "Admin | Role | Edit";
        $page_description = trans('admin/roles/general.page.edit.description'); // "Editing role";

        $role = $this->role->find($id);

        if( !$role->isEditable() &&  !$role->canChangePermissions() )
        {
            abort(403);
        }

        $perms = $this->permission->all();
        $rolePerms = $role->perms();

        return view('admin.roles.edit', compact('role', 'perms', 'rolePerms', 'page_title', 'page_description'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array('name' => 'required', 'display_name' => 'required'));

        $role = $this->role->find($id);

        if ($role->isEditable())
        {
            $role->update($request->all());
        }

        if ($role->canChangePermissions())
        {
            $role->savePermissions($request->get('perms'));
        }

        $role->forcePermission('basic-authenticated');

        Flash::success( trans('admin/roles/general.status.updated') ); // 'Role successfully updated');

        return redirect('/admin/roles');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $role = $this->role->find($id);

        if (!$role->isdeletable())
        {
            abort(403);
        }

        $this->role->delete($id);

        Flash::success( trans('admin/roles/general.status.deleted') ); // 'Role successfully deleted');

        return redirect('/admin/roles');
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

        $role = $this->role->find($id);

        if (!$role->isdeletable())
        {
            abort(403);
        }

        $modal_title = trans('admin/roles/dialog.delete-confirm.title');
        $modal_cancel = trans('general.button.cancel');
        $modal_ok = trans('general.button.ok');

        $role = $this->role->find($id);
        $modal_route = route('admin.roles.delete', array('id' => $role->id));

        $modal_body = trans('admin/roles/dialog.delete-confirm.body', ['id' => $role->id, 'name' => $role->name]);

        return view('modal_confirmation', compact('error', 'modal_route',
            'modal_title', 'modal_body', 'modal_cancel', 'modal_ok'));

    }

}