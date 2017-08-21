<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Events\UserUpdated;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Log;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laratrust\Traits\LaratrustUserTrait;

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
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->first_name . " " . $this->last_name;
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
            $this->roles()->attach($roleToForce->id);
        }
    }

    /**
     * Alias to eloquent many-to-many relation's sync() method.
     *
     * @param array $attributes
     */
    private function assignMembership(array $attributes = [])
    {
        if (array_key_exists('role', $attributes) && ($attributes['role'])) {
            $this->roles()->sync($attributes['role']);
        } else {
            $this->roles()->sync([]);
        }
    }

    /**
     * Alias to eloquent many-to-many relation's sync() method.
     *
     * @param array $attributes
     */
    private function assignPermission(array $attributes = [])
    {
        if (array_key_exists('perms', $attributes) && ($attributes['perms'])) {
            $this->permissions()->sync($attributes['perms']);
        } else {
            $this->permissions()->sync([]);
        }
    }

    /**
     * Overwrite Model::create(...) to fire event.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $attributes = [])
    {

        // Call original create method from parent
        $user = parent::create($attributes);

        event(new UserCreated($user));

        return $user;
    }

    /**
     * Force the membership to the 'core.users' role
     * and if empty, set the auth_type to the
     * internal value.
     * Usually called from the UserEventSubscriber@onUserCreated
     * handler.
     */
    public function postCreateFix()
    {
        Log::debug("User created: " . $this->username);

        // Force membership to the Users role.
        $this->forceRole('core.users');

        // If the auth_type is not explicitly set by the call function or module,
        // set it to the internal value.
        if (isEmptyOrNullString($this->auth_type)) {
            // TODO: Get internal type form Settings.
            $this->auth_type = 'internal';
        }

        // Save changes.
        $this->save();

    }

    /**
     * Overwrite Model::update(...) to fire event.
     *
     * to save group membership if included,
     * or clear it if not. Also force membership to group 'users'.
     *
     * @param array $attributes
     * @return boolean
     */
    public function update(array $attributes = [], array $options = [])
    {

//        // TODO: Deal with user's Settings
//        if ( array_key_exists('username', $attributes) ) {
//            if ( $attributes['username'] != $this->username ) {
//                // Forget settings associated to previous username. New settings will be saved bellow.
//                Setting::forget($this->settings()->prefix());
//            }
////            $this->username = $attributes['username']; // TODO: Is this needed ??
//        }

        if (parent::update($attributes, $options))
        {

            event(new UserUpdated($this));

            // Assign membership(s)
            $this->assignMembership($attributes);
            // Assign permission(s)
            $this->assignPermission($attributes);

            return true;
        } else {
            return false;
        }


//        // TODO: Deal with user's Settings
//        // Process user settings
//        $this->processUserSetting('theme', $attributes);
//        $tzIdentifiers = \DateTimeZone::listIdentifiers();
//        $this->processUserSetting('time_zone', $attributes, $tzIdentifiers);
//        $this->processUserSetting('time_format', $attributes);
//        $this->processUserSetting('locale', $attributes);

    }

    /**
     * Force the membership to the 'core.users' role.
     * Usually called from the UserEventSubscriber@onUserUpdated
     * handler.
     */
    public function postUpdateFix()
    {
        Log::debug("User created: " . $this->username);

        // Force membership to group 'users'
        $this->forceRole('core.users');

        // Save changes.
        $this->save();
    }
}
