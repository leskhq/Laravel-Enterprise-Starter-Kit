<?php

namespace App\Models;

use App\Events\PermissionCreated;
use App\Events\PermissionCreating;
use App\Events\PermissionDeleted;
use App\Events\PermissionDeleting;
use App\Events\PermissionRestored;
use App\Events\PermissionRestoring;
use App\Events\PermissionSaved;
use App\Events\PermissionSaving;
use App\Events\PermissionUpdated;
use App\Events\PermissionUpdating;
use App\Libraries\Str;
use Log;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
//use Laratrust\LaratrustPermission; // Laratrust 4
use Laratrust\Models\LaratrustPermission; // Laratrust 5

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property int $enabled
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read bool $is_used
 * @property-read bool $is_used_by_role
 * @property-read bool $is_used_by_route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Route[] $routes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends LaratrustPermission implements Transformable
{
    use TransformableTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description', 'enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating'  => PermissionCreating::class,
        'created'   => PermissionCreated::class,
        'updating'  => PermissionUpdating::class,
        'updated'   => PermissionUpdated::class,
        'saving'    => PermissionSaving::class,
        'saved'     => PermissionSaved::class,
        'deleting'  => PermissionDeleting::class,
        'deleted'   => PermissionDeleted::class,
        'restoring' => PermissionRestoring::class,
        'restored'  => PermissionRestored::class,
    ];

    public function routes()
    {
        return $this->hasMany('App\Models\Route');
    }

//    public function menu()
//    {
//        return $this->hasMany('App\Models\Menu');
//    }

// TODO: Is this needed.
//    /**
//     * @param $roleName
//     *
//     * @return bool
//     */
//    public function hasRole($roleName)
//    {
//        foreach ($this->roles as $role) {
//            if ($role->name == $roleName) {
//                return true;
//            }
//        }
//        return false;
//    }

    /**
     * @return bool
     */
    public function getIsUsedByRoleAttribute()
    {
        return ($this->roles->count() > 0);
    }

    /**
     * @return bool
     */
    public function getIsUsedByRouteAttribute()
    {
        return ($this->routes->count() > 0);
    }

    /**
     * @return bool
     */
    public function getIsUsedAttribute()
    {
        return ($this->is_used_by_role || $this->is_used_by_route || $this->is_used_by_user);
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the guest-only and basic-authenticated permissions from edits.
        if (('guest-only' == $this->name) ||
            ('basic-authenticated' == $this->name)
        ) {
            return false;
        }
        // Otherwise
        return true;
    }

    /**
     * @return bool
     */
    public function isDeletable()
    {
        // Protect the guest-only, basic-authenticated and open-to-all permissions from deletion.
        if (('guest-only' == $this->name) ||
            ('basic-authenticated' == $this->name) ||
            ('open-to-all' == $this->name) ||
            ($this->is_used)
        ) {
            return false;
        }
        // Otherwise
        return true;
    }


    /**
     * @return bool
     */
    public function canBeAssigned()
    {
        if ('guest-only' == $this->name) {
            return false;
        }

        return true;
    }

    /**
     * @param $perm
     * @return bool
     */
    public static function isForced($perm)
    {
        if ('basic-authenticated' == $perm->name) {
            return true;
        }

        return false;
    }

    /**
     * @param array $attributes
     */
    public function assignRoutes(array $attributes = [])
    {
        if (array_key_exists('routes', $attributes) && (is_array($attributes['routes'])) && ("" != $attributes['routes'][0])) {
            $this->clearRouteAssociation();

            foreach ($attributes['routes'] as $id) {
                $route = \App\Models\Route::find($id);
                $this->routes()->save($route);
            }
        } else {
            $this->clearRouteAssociation();
        }
    }

    /**
     * @param array $attributes
     */
    public function assignRoles(array $attributes = [])
    {
        if (array_key_exists('roles', $attributes) && (is_array($attributes['roles'])) && ("" != $attributes['roles'][0])) {
            $this->roles()->sync($attributes['roles']);
        } else {
            $this->roles()->sync([]);
        }
    }

    public function clearRouteAssociation()
    {
        foreach ($this->routes as $route) {
            $route->permission()->dissociate();
            $route->save();
        }
        $this->save();
    }

    public function forceUserAssignment($userName)
    {
        // If the permission is not already assigned to the given user
        if (null == $this->users()->where('username', $userName)->first()) {
            // Load the given user and attach it to the permission.
            $userToForce = \App\Models\User::where('username', $userName)->first();
            if (null != $userToForce) {
                $this->users()->attach($userToForce->id);
            }
        }
    }

    public function forceRoleAssignment($roleName)
    {
        // If the permission is not already assigned to the given user
        if (null == $this->roles()->where('name', $roleName)->first()) {
            // Load the given user and attach it to the permission.
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
        Log::debug('Permission.postCreateAndUpdateFix. ', ['permission' => $this->name]);

        // Force assignment to the root user.
        $this->forceUserAssignment('root');

        // Force assignment to the admins.
        $this->forceRoleAssignment('core.admins');

        // Temporally disable the event dispatcher to avoid getting in an infinite loop of update events.
        $dispatcher = $this->getEventDispatcher();
        $this->unsetEventDispatcher();
        // Save changes.
        $this->save();
        // Restore event dispatcher.
        $this->setEventDispatcher($dispatcher);

    }


}
