<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Libraries\Arr;
use App\Libraries\Str;
use App\Models\User;
use App\Repositories\Criteria\Permission\PermissionsByNamesAscending;
use App\Repositories\Criteria\Role\RolesByNamesAscending;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Auth;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Settings;
use Zofe\Rapyd\DataGrid\DataGrid;


class UsersController extends Controller
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
     * @var UserValidator
     */
    protected $validator;

    public function __construct(UserRepository $userRepository, UserValidator $validator, PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->user         = $userRepository;
        $this->validator    = $validator;
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
        $grid = DataGrid::source(User::with(['roles', 'permissions']));

        $grid->add('id','ID', true)->style("width:100px");

        if (Auth::user()->hasPermission('core.users.read')) {
            $grid->add('{{ link_to_route(\'admin.users.show\', $username, [$id], []) }}','User name', 'username');
        } else {
            $grid->add('username','User name', 'username');
        }

        $grid->add('fullname','Name', false);
        $grid->add('{{ $roles->count() }}','Roles', false);
        $grid->add('{{ $permissions->count() }}','Permissions', false);
        $grid->add('email','Email', true);
        $grid->add('auth_type','Type', true);
        $grid->add( '{!! App\Libraries\Utils::userActionslinks($id) !!}', 'Actions');

        $grid->orderBy('id','asc');
        $grid->paginate(10);

        $page_title = trans('admin/users/general.page.index.title');
        $page_description = trans('admin/users/general.page.index.description');

        return view('admin.users.index', compact('grid', 'page_title', 'page_description'));
    }
    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page_title = trans('admin/users/general.page.create.title'); // "Admin | User | Create";
        $page_description = trans('admin/users/general.page.create.description'); // "Creating a new user";

        $roles = $this->role->pushCriteria(new RolesByNamesAscending())->all();
        $perms = $this->permission->pushCriteria(new PermissionsByNamesAscending())->all();
        $user = new \App\Models\User();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);

        $timezones = \DateTimeZone::listIdentifiers();
        $timezone = $user->settings()->get('app.timezone', null);
        $tzKey = array_search($timezone, $timezones);

        $time_format = $user->settings()->get('app.time_format', null);

        $locales = Settings::get('app.supportedLocales');

        return view('admin.users.create', compact('user', 'perms', 'roles', 'themes', 'timezones', 'tzKey', 'time_format', 'locales', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            // Validate attributes.
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);

            // Create basic user
            $user = $this->user->create($attributes);

            // Save role membership(s).
            $this->saveRoles($user, $attributes);
            // Save permission(s).
            $this->savePermission($user, $attributes);
            // Save settings.
            $this->saveSettings($user, $attributes);

            Flash::success(trans('admin/users/general.status.created'));

            return redirect('/admin/users');

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
        $user = $this->user->with(['permissions', 'roles'])->find($id);

        $page_title = trans('admin/users/general.page.show.title');
        $page_description = trans('admin/users/general.page.show.description', ['full_name' => $user->full_name]);

        $roles = $this->role->pushCriteria(new RolesByNamesAscending())->all();
        $permissions = $this->permission->pushCriteria(new PermissionsByNamesAscending())->all();
        $time_format = $user->settings()->get('app.time_format', null);
        $locales = Settings::get('app.supportedLocales');
        $localeIdent = $user->settings()->get('app.locale', null);
        if (!Str::isNullOrEmptyString($localeIdent)) {
            $locale = $locales[$localeIdent];
        } else {
            $locale = "";
        }

        return view('admin.users.show', compact('user', 'page_title', 'page_description', 'permissions', 'roles', 'time_format', 'locale'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->user->find($id);

        $page_title = trans('admin/users/general.page.edit.title');
        $page_description = trans('admin/users/general.page.edit.description', ['full_name' => $user->full_name]);

        $roles = $this->role->pushCriteria(new RolesByNamesAscending())->all();
        $perms = $this->permission->pushCriteria(new PermissionsByNamesAscending())->all();

        $themes = \Theme::getList();
        $themes = Arr::indexToAssoc($themes, true);

        $timezones = \DateTimeZone::listIdentifiers();
        $timezone = $user->settings()->get('app.timezone', null);
        $tzKey = array_search($timezone, $timezones);

        $time_format = $user->settings()->get('app.time_format', null);

        $locales = Settings::get('app.supportedLocales');

        return view('admin.users.edit', compact('user', 'roles', 'perms', 'themes', 'timezones', 'tzKey', 'time_format', 'locales', 'page_title', 'page_description'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try {

            // Get all attribute from the request.
            $attributes = $request->all();

            // Validate attributes.
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            // Locate user
            $user = $this->user->find($id);

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

            // Save role membership(s).
            $this->saveRoles($user, $attributes);
            // Save permission(s).
            $this->savePermission($user, $attributes);
            // Save settings.
            $this->saveSettings($user, $attributes);

            // Save all other attributes.
            $user->update($attributes);

            if ($passwordChanged) {
//                $user->emailPasswordChange();
            }

            Flash::success(trans('admin/users/general.status.updated'));

            return redirect('/admin/users');

        } catch (ValidatorException $e) {
            Flash::error(trans('admin/users/general.status.user-update-failed', ['failure' => $e->getMessageBag()]));
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        Flash::success( trans('admin/users/general.status.deleted') );

        return redirect()->back()->with('message', 'User deleted.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        $user = $this->user->find($id);

//        Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-enable', ['username' => $user->username]));

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
//            Audit::log(Auth::user()->id, trans('admin/users/general.audit-log.category'), trans('admin/users/general.audit-log.msg-disabled', ['username' => $user->username]));

            $user->enabled = false;
            $user->save();
            Flash::success(trans('admin/users/general.status.disabled'));
        }

        return redirect('/admin/users');
    }

    /**
     * Save the roles for a user from the attributes submitted.
     *
     * @param User $user
     * @param array $attributes
     */
    private function saveRoles(User $user, array $attributes = [])
    {
        if (array_key_exists('roles', $attributes) && ($attributes['roles'])) {
            $user->roles()->sync($attributes['roles']);
        } else {
            $attributes['role'] = [];
            $user->roles()->sync([]);
        }

    }

    /**
     * Save the permissions for a user from the attributes submitted.
     *
     * @param User $user
     * @param array $attributes
     */
    private function savePermission(User $user, array $attributes = [])
    {
        if (array_key_exists('perms', $attributes) && ($attributes['perms'])) {
            $user->permissions()->sync($attributes['perms']);
        } else {
            $user->permissions()->sync([]);
        }
    }

    /**
     * Save settings for a user from the attributes submitted.
     * @param User $user
     * @param array $attributes
     */
    private function saveSettings(User $user, array $attributes = [])
    {
        if (array_key_exists('settings', $attributes) && ($attributes['settings'])) {
            foreach ($attributes['settings'] as $key => $value) {
                switch ($key) {
                    case "app.timezone":
                        $tzIdentifiers = \DateTimeZone::listIdentifiers();
                        $value = $tzIdentifiers[$value];
                        break;
                }

                if ('' != trim($value)) {
                    $user->settings()->set($key, $value);
                } else {
                    $user->settings()->forget($key);

                }
            }
        }
    }
}
