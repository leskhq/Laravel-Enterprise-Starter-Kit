<?php namespace App\Http\Controllers;

use App\Repositories\Criteria\Role\RolesWithPermissions;
use App\Repositories\Criteria\Role\RolesByNamesAscending;
use App\Repositories\RoleRepository as Role;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\UserRepository as User;
use Illuminate\Http\Request;
use Flash;
use DB;

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
     * @var User
     */
    private $user;

    /**
     * @param Role $role
     * @param Permission $permission
     * @param User $user
     */
    public function __construct(Role $role, Permission $permission, User $user)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->user = $user;
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
        $role = $this->role->find($id);

        $page_title = trans('admin/roles/general.page.show.title'); // "Admin | Role | Show";
        $page_description = trans('admin/roles/general.page.show.description', ['name' => $role->name]); // "Displaying role";

        $perms = $this->permission->all();
//        $userCollection = \App\User::take(10)->get(['id', 'first_name', 'last_name', 'username'])->lists('full_name_and_username', 'id');
//        $userList = [''=>''] + $userCollection->all();

        return view('admin.roles.show', compact('role', 'perms', 'page_title', 'page_description'));
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

        $attributes = $request->all();

        if ( array_key_exists('selected_users', $attributes) ) {
            $attributes['users'] = explode(",", $attributes['selected_users']);
        }
        $role = $this->role->create($attributes);

        $role->savePermissions($request->get('perms'));
        $role->forcePermission('basic-authenticated');
        $role->saveUsers($attributes['users']);

        Flash::success( trans('admin/roles/general.status.created') ); // 'Role successfully created');

        return redirect('/admin/roles');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = $this->role->find($id);

        $page_title = trans('admin/roles/general.page.edit.title'); // "Admin | Role | Edit";
        $page_description = trans('admin/roles/general.page.edit.description', ['name' => $role->name]); // "Editing role";

        if( !$role->isEditable() &&  !$role->canChangePermissions() )
        {
            abort(403);
        }

        $perms = $this->permission->all();
//        $rolePerms = $role->perms();
//        $userCollection = \App\User::take(10)->get(['id', 'first_name', 'last_name', 'username'])->lists('full_name_and_username', 'id');
//        $userList = [''=>''] + $userCollection->all();

        return view('admin.roles.edit', compact('role', 'perms', 'page_title', 'page_description'));
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

        $attributes = $request->all();

        if ( array_key_exists('selected_users', $attributes) ) {
            $attributes['users'] = explode(",", $attributes['selected_users']);
        } else {
            $attributes['users'] = [];
        }

        if ($role->isEditable())
        {
            $role->update($attributes);
        }

        if ($role->canChangePermissions())
        {
            $role->savePermissions($request->get('perms'));
        }

        $role->forcePermission('basic-authenticated');

        if ($role->canChangeMembership())
        {
            $role->saveUsers($attributes['users']);
        }

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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $role = $this->role->find($id);
        $role->enabled = true;
        $role->save();

        Flash::success(trans('admin/roles/general.status.enabled'));

        return redirect('/admin/roles');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        //TODO: Should we protect 'admins', 'users'??

        $role = $this->role->find($id);
        $role->enabled = false;
        $role->save();

        Flash::success(trans('admin/roles/general.status.disabled'));

        return redirect('/admin/roles');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $chkRoles = $request->input('chkRole');

        if (isset($chkRoles))
        {
            foreach ($chkRoles as $role_id)
            {
                $role = $this->role->find($role_id);
                $role->enabled = true;
                $role->save();
            }
            Flash::success(trans('admin/roles/general.status.global-enabled'));
        }
        else
        {
            Flash::warning(trans('admin/roles/general.status.no-role-selected'));
        }
        return redirect('/admin/roles');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        //TODO: Should we protect 'admins', 'users'??

        $chkRoles = $request->input('chkRole');

        if (isset($chkRoles))
        {
            foreach ($chkRoles as $role_id)
            {
                $role = $this->role->find($role_id);
                $role->enabled = false;
                $role->save();
            }
            Flash::success(trans('admin/roles/general.status.global-disabled'));
        }
        else
        {
            Flash::warning(trans('admin/roles/general.status.no-role-selected'));
        }
        return redirect('/admin/roles');
    }

    /**
     * @param Request $request
     * @return array|static[]
     */
    public function searchByName(Request $request)
    {
        $name = $request->input('query');
        $roles = DB::table('roles')
            ->select(DB::raw('id, display_name || " (" || name || ")" as text'))
            ->where('display_name', 'like', "%$name%")
            ->orWhere('name', 'like', "%$name%")
            ->get();
        return $roles;
    }


}