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
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
     * Force the membership to the 'core.users' role
     * and if empty, set the auth_type to the
     * internal value.
     * Usually called from the UserEventSubscriber@onUserCreated
     * handler.
     */
    public function postCreateAndUpdateFix()
    {
        Log::debug('User.postCreateAndUpdateFix. ', ['username' => $this->username]);

        // Force membership to the Users role.
        $this->forceRole('core.users');

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

    public function postDeleteFix()
    {
        Log::debug('User.postDeleteFix. ', ['username' => $this->username]);

        $this->settings()->forget();

    }

}
