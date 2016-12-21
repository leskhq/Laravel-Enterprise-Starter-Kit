<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Libraries\Arr;
use App\Libraries\Str;
use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\Permission\PermissionsByNamesAscending;
use App\Repositories\Criteria\Role\RolesByNamesAscending;
use App\Repositories\Criteria\User\UsersByUsernamesAscending;
use App\Repositories\Criteria\User\UsersWhereFirstNameOrLastNameOrUsernameLike;
use App\Repositories\Criteria\User\UsersWithRoles;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\RoleRepository as Role;
use App\Repositories\UserRepository as User;
use Auth;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Mail;
use Setting;

class UsersController extends Controller
{

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var Permission
     */
    protected $perm;

    /**
     * @param User $user
     * @param Role $role
     */
    public function __construct(Application $app, Audit $audit, User $user, Role $role, Permission $perm)
    {
        parent::__construct($app, $audit);
        $this->user  = $user;
        $this->role  = $role;
        $this->perm  = $perm;
        // Set default crumbtrail for controller.
        session(['crumbtrail.leaf' => 'users']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-index'));

        $page_title = trans('admin/users/general.page.index.title'); // "Admin | Users";
        $page_description = trans('admin/users/general.page.index.description'); // "List of users";

        $users = $this->user->pushCriteria(new UsersWithRoles())->pushCriteria(new UsersByUsernamesAscending())->paginate(10);
        return view('admin.users.index', compact('users', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-show', ['username' => $user->username]));

        $page_title = trans('admin/users/general.page.show.title'); // "Admin | User | Show";
        $page_description = trans('admin/users/general.page.show.description', ['full_name' => $user->full_name]); // "Displaying user";

        $perms = $this->perm->pushCriteria(new PermissionsByNamesAscending())->all();

        $time_format = $user->settings()->get('time_format', null);
        $locales = Setting::get('app.supportedLocales');
        $localeIdent = $user->settings()->get('locale', null);
        if (!Str::isNullOrEmptyString($localeIdent)) {
            $locale = $locales[$localeIdent];
        } else {
            $locale = "";
        }

        return view('admin.users.show', compact('user', 'perms', 'theme', 'time_format', 'locale', 'page_title', 'page_description'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $page_title = trans('admin/users/general.page.create.title'); // "Admin | User | Create";
        $page_description = trans('admin/users/general.page.create.description'); // "Creating a new user";

        $perms = $this->perm->pushCriteria(new PermissionsByNamesAscending())->all();
        $user = new \App\User();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);

        $time_zones = \DateTimeZone::listIdentifiers();
        $time_zone = $user->settings()->get('time_zone', null);
        $tzKey = array_search($time_zone, $time_zones);

        $time_format = $user->settings()->get('time_format', null);

        $locales = Setting::get('app.supportedLocales');

        return view('admin.users.create', compact('user', 'perms', 'themes', 'time_zones', 'tzKey', 'time_format', 'locales', 'page_title', 'page_description'));
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $this->validate($request, \app\User::getCreateValidationRules());

        $attributes = $request->all();

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-store', ['username' => $attributes['username']]));

        if ( (array_key_exists('selected_roles', $attributes)) && (!empty($attributes['selected_roles'])) ) {
            $attributes['role'] = explode(",", $attributes['selected_roles']);
        } else {
            $attributes['role'] = [];
        }

        // Create basic user.
        $user = $this->user->create($attributes);
        // Run the update method to set enabled status and roles membership.
        $user->update($attributes);

        Flash::success( trans('admin/users/general.status.created') ); // 'User successfully created');

        return redirect('/admin/users');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-edit', ['username' => $user->username]));

        $page_title = trans('admin/users/general.page.edit.title'); // "Admin | User | Edit";
        $page_description = trans('admin/users/general.page.edit.description', ['full_name' => $user->full_name]); // "Editing user";

        $roles = $this->role->pushCriteria(new RolesByNamesAscending())->all();
        $perms = $this->perm->pushCriteria(new PermissionsByNamesAscending())->all();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);

        $time_zones = \DateTimeZone::listIdentifiers();
        $time_zone = $user->settings()->get('time_zone', null);
        $tzKey = array_search($time_zone, $time_zones);

        $time_format = $user->settings()->get('time_format', null);

        $locales = Setting::get('app.supportedLocales');

        return view('admin.users.edit', compact('user', 'roles', 'perms', 'themes', 'time_zones', 'tzKey', 'time_format', 'locales', 'page_title', 'page_description'));
    }

    static public function ParseUpdateAuditLog($id)
    {
        $permsObj = [];
        $permsNoFound = [];
        $rolesObj = [];
        $rolesNotFound = [];

        $audit   = \App\Models\Audit::find($id);
        $dataAtt = json_decode($audit->data, true);

        // Lookup and load the perms that we can still find, otherwise add to an separate array.
        if (array_key_exists('perms', $dataAtt)) {
            foreach($dataAtt['perms'] as $id) {
                $perm = \App\Models\Permission::find($id);
                if ($perm) {
                    $permsObj[] = $perm;
                }
                else {
                    $permsNoFound[] = trans('admin/users/general.error.perm_not_found', ['id' => $id]);
                }
            }
        }
        $dataAtt['permsObj'] = $permsObj;
        $dataAtt['permsNotFound'] = $permsNoFound;

        // Lookup and load the roles that we can still find, otherwise add to an separate array.
        if (array_key_exists('selected_roles', $dataAtt)) {
            $aRolesIDs = explode(",", $dataAtt['selected_roles']);
            foreach($aRolesIDs as $id) {
                $role = \App\Models\Role::find($id);
                if ($role) {
                    $rolesObj[] = $role;
                }
                else {
                    $rolesNotFound[] = trans('admin/users/general.error.perm_not_found', ['id' => $id]);
                }
            }
        }
        $dataAtt['rolesObj'] = $rolesObj;
        $dataAtt['rolesNotFound'] = $rolesNotFound;

        // Add the file name of the partial (blade) that will render this data.
        $dataAtt['show_partial'] = 'admin/users/_audit_log_data_viewer_update';

        return $dataAtt;
    }

    /**
     * Loads the audit log item from the id passed in, locate the relevant user, then overwrite all current attributes
     * of the user with the values from the audit log data field. Once the user saved, redirect to the edit page,
     * where the operator can inspect and further edit if needed.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function replayEdit($id)
    {
        // Loading the audit in question.
        $audit = $this->audit->find($id);
        // Getting the attributes from the data fields.
        $att = json_decode($audit->data, true);
        // Finding the user to operate on from the id field that was populated in the
        // edit action that created this audit record.
        $user = $this->user->find($att['id']);

        if (null == $user) {
            Flash::warning( trans('admin/users/general.error.user_not_found', [ 'id' => $att['id'] ]) );
            return \Redirect::route('admin.audit.index');
        }

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-replay-edit', ['username' => $user->username]));

        $page_title = trans('admin/users/general.page.edit.title'); // "Admin | User | Edit";
        $page_description = trans('admin/users/general.page.edit.description', ['full_name' => $user->full_name]); // "Editing user";

        if ($user->isRoot())
        {
            abort(403);
        }

        // Setting user attributes with values from audit log to replay the requested action.
        // Password is not replayed.
        $user->first_name = $att['first_name'];
        $user->last_name = $att['last_name'];
        $user->username = $att['username'];
        $user->email = $att['email'];
        $user->enabled = $att['enabled'];
        if (array_key_exists('selected_roles', $att)) {
            $aRoleIDs = explode(",", $att['selected_roles']);
            $user->roles()->sync($aRoleIDs);
        }
        if (array_key_exists('perms', $att)) {
            $user->permissions()->sync($att['perms']);
        }
        $user->save();


        $roles = $this->role->all();
        $perms = $this->perm->all();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);
        $theme = $att['theme'];

        $time_zones = \DateTimeZone::listIdentifiers();
        $tzKey = $att['time_zone'];

        $time_format = $att['time_format'];

        $locales = Setting::get('app.supportedLocales');
        $locale = $att['locale'];

        return view('admin.users.edit', compact('user', 'roles', 'perms', 'themes', 'theme', 'time_zones', 'tzKey', 'time_format', 'locale', 'locales', 'page_title', 'page_description'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->validate($request, \app\User::getUpdateValidationRules($id));

        $user = $this->user->find($id);

        // Get all attribute from the request.
        $attributes = $request->all();

        // Set passwordChanged flag
        $passwordChanged = false;
        // Fix #17 as per @sloan58
        // Check if the password was submitted and has changed.
        if(!\Hash::check($attributes['password'],$user->password) && $attributes['password'] != '')
        {
            // Password was changed, set flag for later.
            $passwordChanged = true;
        }
        else
        {
            // Password was not changed or was not submitted, delete attribute from array to prevent it
            // from being set to blank.
            unset($attributes['password']);
            // Set flag just to be sure
            $passwordChanged = false;
        }

        // Get a copy of the attributes that we will modify to save for a replay.
        $replayAtt = $attributes;
        // Add the id of the current user for the replay action.
        $replayAtt["id"] = $id;
        // Create log entry with replay data.
        $tmp = Audit::log( Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-update', ['username' => $user->username]),
            $replayAtt, "App\Http\Controllers\UsersController::ParseUpdateAuditLog", "admin.users.replay-edit" );


        if ( (array_key_exists('selected_roles', $attributes)) && (!empty($attributes['selected_roles'])) ) {
            $attributes['role'] = explode(",", $attributes['selected_roles']);
        } else {
            $attributes['role'] = [];
        }

        if ($user->isRoot())
        {
            // Prevent changes to some fields for the root user.
            unset($attributes['username']);
            unset($attributes['first_name']);
            unset($attributes['last_name']);
            unset($attributes['enabled']);
            unset($attributes['selected_roles']);
            unset($attributes['role']);
            unset($attributes['perms']);
        }

        $user->update($attributes);
        if ($passwordChanged) {
            $user->emailPasswordChange();
        }

        Flash::success( trans('admin/users/general.status.updated') );

        return redirect('/admin/users');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (!$user->isdeletable())
        {
            abort(403);
        }

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-destroy', ['username' => $user->username]));

        $this->user->delete($id);

        Flash::success( trans('admin/users/general.status.deleted') );

        return redirect('/admin/users');
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

        $user = $this->user->find($id);

        if (!$user->isdeletable())
        {
            abort(403);
        }

        $modal_title = trans('admin/users/dialog.delete-confirm.title');

        if (Auth::user()->id !== $id) {
            $user = $this->user->find($id);
            $modal_route = route('admin.users.delete', array('id' => $user->id));

            $modal_body = trans('admin/users/dialog.delete-confirm.body', ['id' => $user->id, 'full_name' => $user->full_name]);
        }
        else
        {
            $error = trans('admin/users/general.error.cant-delete-yourself');
        }
        return view('modal_confirmation', compact('error', 'modal_route', 'modal_title', 'modal_body'));

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $user = $this->user->find($id);

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-enable', ['username' => $user->username]));

        $user->enabled = true;
        $user->save();

        Flash::success(trans('admin/users/general.status.enabled'));

        return redirect('/admin/users');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        $user = $this->user->find($id);

        if (!$user->canBeDisabled())
        {
            Flash::error(trans('admin/users/general.error.cant-be-disabled'));
        }
        else
        {
            Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-disabled', ['username' => $user->username]));

            $user->enabled = false;
            $user->save();
            Flash::success(trans('admin/users/general.status.disabled'));
        }

        return redirect('/admin/users');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enableSelected(Request $request)
    {
        $chkUsers = $request->input('chkUser');

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-enabled-selected'), $chkUsers);

        if (isset($chkUsers))
        {
            foreach ($chkUsers as $user_id)
            {
                $user = $this->user->find($user_id);
                $user->enabled = true;
                $user->save();
            }
            Flash::success(trans('admin/users/general.status.global-enabled'));
        }
        else
        {
            Flash::warning(trans('admin/users/general.status.no-user-selected'));
        }
        return redirect('/admin/users');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function disableSelected(Request $request)
    {
        $chkUsers = $request->input('chkUser');

        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-disabled-selected'), $chkUsers);

        if (isset($chkUsers))
        {
            foreach ($chkUsers as $user_id)
            {
                $user = $this->user->find($user_id);
                if (!$user->canBeDisabled())
                {
                    Flash::error(trans('admin/users/general.error.cant-be-disabled'));
                }
                else
                {
                    $user->enabled = false;
                    $user->save();
                }
            }
            Flash::success(trans('admin/users/general.status.global-disabled'));
        }
        else
        {
            Flash::warning(trans('admin/users/general.status.no-user-selected'));
        }
        return redirect('/admin/users');
    }

    public function searchByName(Request $request)
    {
        $return_arr = null;

        $query = $request->input('query');

        $users = $this->user->pushCriteria(new UsersWhereFirstNameOrLastNameOrUsernameLike($query))->all();

        foreach ($users as $user) {
            $id = $user->id;
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $username = $user->username;

            $entry_arr = [ 'id' => $id, 'text' => "$first_name $last_name ($username)"];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;
    }

    public function listByPage(Request $request)
    {
        $skipNumb = $request->input('s');
        $takeNumb = $request->input('t');

        $userCollection = \App\User::skip($skipNumb)->take($takeNumb)
            ->get(['id', 'first_name', 'last_name', 'username'])
            ->lists('full_name_and_username', 'id');
        $userList = $userCollection->all();

        return $userList;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getInfo(Request $request)
    {
        $id = $request->input('id');
        $user = $this->user->find($id);

        return $user;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        Audit::log(Auth::user()->id, trans('general.audit-log.category-profile'), trans('general.audit-log.msg-profile-show', ['username' => $user->username]));

        $page_title = trans('general.page.profile.title');
        $page_description = trans('general.page.profile.description', ['full_name' => $user->full_name]);
        $readOnlyIfLDAP = ('ldap' == $user->auth_type) ? 'readonly' : '';
        $perms = $this->perm->pushCriteria(new PermissionsByNamesAscending())->all();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);
        $theme = $user->settings()->get('theme');

        $time_zones = \DateTimeZone::listIdentifiers();
        $time_zone = $user->settings()->get('time_zone');
        $tzKey = array_search($time_zone, $time_zones);

        $time_format = $user->settings()->get('time_format');

        $locales = Setting::get('app.supportedLocales');
        $locale = $user->settings()->get('locale');

        // Unset default crumbtrail set in controller ctor.
        session()->pull('crumbtrail.leaf');
        return view('user.profile', compact('user', 'perms', 'themes', 'theme', 'time_zones', 'tzKey', 'time_format', 'locale', 'locales', 'readOnlyIfLDAP', 'page_title', 'page_description'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profileUpdate(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $this->validate($request, \app\User::getUpdateValidationRules($user->id));

        Audit::log(Auth::user()->id, trans('general.audit-log.category-profile'), trans('general.audit-log.msg-profile-update', ['username' => $user->username]));

        // Get all attribute from the request.
        $attributes = $request->all();

        // Set passwordChanged flag
        $passwordChanged = false;
        // Fix #17 as per @sloan58
        // Check if the password was submitted and has changed.
        if(!\Hash::check($attributes['password'],$user->password) && $attributes['password'] != '')
        {
            // Password was changed, set flag for later.
            $passwordChanged = true;
        }
        else
        {
            // Password was not changed or was not submitted, delete attribute from array to prevent it
            // from being set to blank.
            unset($attributes['password']);
            // Set flag just to be sure
            $passwordChanged = false;
        }
        // Prevent changes to some fields for the root user.
        if ($user->isRoot())
        {
            unset($attributes['username']);
            unset($attributes['first_name']);
            unset($attributes['last_name']);
            unset($attributes['enabled']);
        }

        // Fix: Editing the profile does not allow to edit the Roles and permissions only to see them.
        // So load the attribute array with current roles and perms to prevent them from being erased.
        $role_ids = [];
        foreach ($user->roles as $role) {
            $role_ids[] = $role->id;
        }
        $attributes['role'] = $role_ids;

        $perm_ids = [];
        foreach ($user->permissions as $perm) {
            $perm_ids[] = $perm->id;
        }
        $attributes['perms'] = $perm_ids;


        // Update user properties.
        $user->update($attributes);
        if ($passwordChanged) {
            $user->emailPasswordChange();
        }

        Flash::success( trans('general.status.profile.updated') );

        return redirect()->route('user.profile');
    }

}