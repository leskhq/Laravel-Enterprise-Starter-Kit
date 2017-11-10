<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Events\UserCreating;
use App\Events\UserDeleted;
use App\Events\UserDeleting;
use App\Events\UserRestored;
use App\Events\UserRestoring;
use App\Events\UserSaved;
use App\Events\UserSaving;
use App\Events\UserUpdated;
use App\Events\UserUpdating;
use App\Libraries\Str;
use Auth;
use Config;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Helper;
use Laratrust\Traits\LaratrustUserTrait;
use Log;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Settings;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $enabled
 * @property string|null $auth_type
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAuthType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePermissionIs($permission = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleIs($role = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 * @property-read string $full_name_and_username
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User freesearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User ofUsername($string)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Audit[] $audits
 */
class User extends Authenticatable implements Transformable
{
    use LaratrustUserTrait;
    use Notifiable;
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'auth_type', 'enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating'  => UserCreating::class,
        'created'   => UserCreated::class,
        'updating'  => UserUpdating::class,
        'updated'   => UserUpdated::class,
        'saving'    => UserSaving::class,
        'saved'     => UserSaved::class,
        'deleting'  => UserDeleting::class,
        'deleted'   => UserDeleted::class,
        'restoring' => UserRestoring::class,
        'restored'  => UserRestored::class,
    ];

    /**
     * Handle on the users settings class.
     *
     * @var Settings
     */
    protected $settings = null;

    /**
     * Return the existing instance of the users settings or create a new one.
     *
     * @return Settings
     */
    public function settings()
    {
        if (null == $this->settings) {
            $this->settings = new UserSetting(app(), $this);
        }
        return $this->settings;
    }

    public function audits ()
    {
        return $this->hasMany(Audit::class);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @return string
     */
    public function getFullNameAndUsernameAttribute()
    {
        return "$this->first_name $this->last_name ($this->username)";
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        // Protect the root user from edits.
        if ('root' == $this->username) {
            return true;
        }
        // Otherwise
        return false;
    }

    /**
     * @return bool
     */
    public function isDeletable()
    {
        // Protect the root user from deletion.
        if ('root' == $this->username) {
            return false;
        }
        // Prevent user from deleting his own account.
        if ( Auth::check() && (Auth::user()->id == $this->id) ) {
            return false;
        }
        // Otherwise
        return true;
    }

    /**
     * @return bool
     */
    public function canBeDisabled()
    {
        // Protect the root user from being disabled.
        if ('root' == $this->username) {
            return false;
        }
        // Prevent user from disabling his own account.
        if ( Auth::check() && (Auth::user()->id == $this->id) ) {
            return false;
        }
        // Otherwise
        return true;
    }

    /**
     * Override LaratrustUserTrait::hasRole(...) with the one addition to,
     * optionally, check if a role is enabled before returning true.
     *
     * @param  string|array  $name           Role name or array of role names.
     * @param  string|bool   $team           Team name or requiredAll roles.
     * @param  bool          $requireAll     All roles in the array are required.
     * @param  bool          $mustBeEnabled  Role must be enabled to count.
     * @return bool
     */
    public function hasRole($name, $team = null, $requireAll = false, $mustBeEnabled = true)
    {
        $name = Helper::standardize($name);
        list($team, $requireAll) = Helper::assignRealValuesTo($team, $requireAll, 'is_bool');

        if (is_array($name)) {
            if (empty($name)) {
                return true;
            }

            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName, $team);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found.
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll.
            return $requireAll;
        }

        $team = Helper::fetchTeam($team);

        foreach ($this->cachedRoles() as $role) {
            $role = Helper::hidrateModel(Config::get('laratrust.models.role'), $role);

            if ($role->name == $name && Helper::isInSameTeam($role, $team)) {
                // If the $mustBeTrue option is enabled, check if the role is enabled.
                if ( $mustBeEnabled ) {
                    if ($role->enabled) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Override LaratrustUserTrait::hasPermission(...) with the one addition to,
     * optionally, check if a role is enabled before returning true.
     *
     * @param  string|array  $permission     Permission string or array of permissions.
     * @param  string|bool   $team           Team name or requiredAll roles.
     * @param  bool          $requireAll     All roles in the array are required.
     * @param  bool          $mustBeEnabled  Role must be enabled to count.
     * @return bool
     */
    public function hasPermission($permission, $team = null, $requireAll = false, $mustBeEnabled = true)
    {
        $permission = Helper::standardize($permission);
        list($team, $requireAll) = Helper::assignRealValuesTo($team, $requireAll, 'is_bool');

        if (is_array($permission)) {
            if (empty($permission)) {
                return true;
            }

            foreach ($permission as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName, $team);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found.
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll.
            return $requireAll;
        }

        $team = Helper::fetchTeam($team);

        foreach ($this->cachedPermissions() as $perm) {
            $perm = Helper::hidrateModel(Config::get('laratrust.models.permission'), $perm);

            if (Helper::isInSameTeam($perm, $team)
                && str_is($permission, $perm->name)) {
                // If the $mustBeTrue option is enabled, check if the permission is enabled.
                if ( $mustBeEnabled ) {
                    if ($perm->enabled) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            }
        }

        foreach ($this->cachedRoles() as $role) {
            $role = Helper::hidrateModel(Config::get('laratrust.models.role'), $role);

            if (Helper::isInSameTeam($role, $team)
                && $role->hasPermission($permission)
            ) {
                return true;
            }
        }

        return false;
    }


    /**
     *
     * Force the user to have the given role.
     *
     * @param $roleName
     */
    public function forceRole($roleName)
    {
        // If the user is not a member to the given role,
        if (null == $this->roles()->where('name', $roleName)->first()) {
            // Load the given role and attach it to the user.
            $roleToForce = \App\Models\Role::where('name', $roleName)->first();
            if (null != $roleToForce) {
                $this->roles()->attach($roleToForce->id);
            }
        }
    }

    /**
     * Force the membership to the 'core.r.users' role
     * and if empty, set the auth_type to the
     * internal value.
     *
     * Usually called from:
     *      UserEventSubscriber@onUserCreated
     *      UserEventSubscriber@onUserUpdated
     */
    public function postCreateAndUpdateFix()
    {
        Log::debug('User.postCreateAndUpdateFix. ', ['username' => $this->username]);

        // Force membership to the Users role.
        $this->forceRole('core.r.users');

        // If the auth_type is not explicitly set by the call function or module,
        // set it to the internal value.
        if (Str::isNullOrEmptyString($this->auth_type)) {
            $this->auth_type = Settings::get('eloquent-ldap.label_internal');
        }

        // Temporally disable the event dispatcher to avoid getting in an infinite loop of update events.
        $dispatcher = $this->getEventDispatcher();
        $this->unsetEventDispatcher();
        // Save changes.
        try {
            $rc = $this->save();
        }
        catch(\Exception $e){
            Log::error('User.postCreateAndUpdateFix save failed: . ', ['exception' => $e->getMessage()]);
        }
        // Restore event dispatcher.
        $this->setEventDispatcher($dispatcher);

    }

    /**
     * Delete user's settings on a delete event.
     *
     * Usually called from:
     *      UserEventSubscriber@onUserDeleted
     */
    public function postDeleteFix()
    {
        Log::debug('User.postDeleteFix. ', ['username' => $this->username]);

        $this->settings()->forget();

    }

    public function scopeFreesearch($query, $value)
    {
        // search against multiple fields using OR
        return $query->where('first_name','like','%'.$value.'%')
            ->orWhere('last_name','like','%'.$value.'%')
            ->orWhere('username','like','%'.$value.'%')
            ->orWhere('email','like','%'.$value.'%')
            // Look into assigned roles
            ->orWhereHas('roles', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%')
                  ->orWhere('display_name','like','%'.$value.'%')
                  ->orWhere('description','like','%'.$value.'%');
            })
            // Look into assigned permissions of roles.
            ->orWhereHas('roles.permissions', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%')
                    ->orWhere('display_name','like','%'.$value.'%')
                    ->orWhere('description','like','%'.$value.'%');
            })
            // Look into assigned permissions
            ->orWhereHas('permissions', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%')
                  ->orWhere('display_name','like','%'.$value.'%')
                  ->orWhere('description','like','%'.$value.'%');
            });

    }

    /**
     * Scope a query to only include users of a given username
     *
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeOfUsername($query, $string)
    {
        return $query->where('username', $string);
    }

}
