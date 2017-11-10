<?php

namespace App\Models;

use App\Events\RoleCreated;
use App\Events\RoleCreating;
use App\Events\RoleDeleted;
use App\Events\RoleDeleting;
use App\Events\RoleRestored;
use App\Events\RoleRestoring;
use App\Events\RoleSaved;
use App\Events\RoleSaving;
use App\Events\RoleUpdated;
use App\Events\RoleUpdating;
use Config;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Helper;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
//use Laratrust\LaratrustRole; // Laratrust 4
use Laratrust\Models\LaratrustRole; // Laratrust 5

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property int $resync_on_login
 * @property int $enabled
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereResyncOnLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role freesearch($value)
 */
class Role extends LaratrustRole implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description', 'resync_on_login', 'enabled'
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
        'creating'  => RoleCreating::class,
        'created'   => RoleCreated::class,
        'updating'  => RoleUpdating::class,
        'updated'   => RoleUpdated::class,
        'saving'    => RoleSaving::class,
        'saved'     => RoleSaved::class,
        'deleting'  => RoleDeleting::class,
        'deleted'   => RoleDeleted::class,
        'restoring' => RoleRestoring::class,
        'restored'  => RoleRestored::class,
    ];

    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the admins and users roles from editing changes
        if (('admins' == $this->name) || ('users' == $this->name)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isDeletable()
    {
        // Protect the admins and users roles from deletion
        if (('core.r.admins' == $this->name) || ('core.r.users' == $this->name)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canChangePermissions()
    {
        // Protect the admins role from permissions changes
        if ('admins' == $this->name) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function canChangeMembership()
    {
        // Protect the users role from membership changes
        if ('users' == $this->name) {
            return false;
        }

        return true;
    }

    /**
     * @param $role
     * @return bool
     */
    public static function isForced($role)
    {
        if ('users' == $role->name) {
            return true;
        }

        return false;
    }

    /**
     * Override LaratrustRoleTrait::hasPermission(...) with the one addition to,
     * optionally, check if a role is enabled before returning true.
     *
     * @param  string|array  $permission     Permission name or array of permission names.
     * @param  bool          $requireAll     All permissions in the array are required.
     * @param  bool          $mustBeEnabled  Role must be enabled to count.
     * @return bool
     */
    public function hasPermission($permission, $requireAll = false, $mustBeEnabled = true)
    {
        // If the $mustBeTrue option is enabled, this role must be enabled to continue.
        if ( ($mustBeEnabled) && (!$this->enabled) ){
            return false;
        }

        if (is_array($permission)) {
            if (empty($permission)) {
                return true;
            }

            foreach ($permission as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found.
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
            // Return the value of $requireAll.
            return $requireAll;
        }

        foreach ($this->cachedPermissions() as $perm) {
            $perm = Helper::hidrateModel(Config::get('laratrust.models.permission'), $perm);

            if (str_is($permission, $perm->name)) {
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

        return false;
    }

    /**
     * Force the role to have the given permission.
     *
     * @param $permissionName
     */
    public function forcePermission($permissionName)
    {
        // If the role has not been given the said permission
        if (null == $this->perms()->where('name', $permissionName)->first()) {
            // Load the given permission and attach it to the role.
            $permToForce = Permission::where('name', $permissionName)->first();
            $this->perms()->attach($permToForce->id);
        }
    }

    /**
     * Save the inputted users.
     *
     * @param mixed $inputUsers
     *
     * @return void
     */
    public function saveUsers($inputUsers)
    {
        if (!empty($inputUsers)) {
            $this->users()->sync($inputUsers);
        } else {
            $this->users()->detach();
        }
    }

    public function scopeFreesearch($query, $value)
    {
        // search against multiple fields using OR
        return $query->where('name','like','%'.$value.'%')
            ->orWhere('display_name','like','%'.$value.'%')
            ->orWhere('description','like','%'.$value.'%')
            // Look into assigned permissions
            ->orWhereHas('permissions', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%')
                    ->orWhere('display_name','like','%'.$value.'%')
                    ->orWhere('description','like','%'.$value.'%');
            })
            // Look into assigned users
            ->orWhereHas('users', function ($q) use ($value) {
                $q->where('username','like','%'.$value.'%')
                    ->orWhere('first_name','like','%'.$value.'%')
                    ->orWhere('last_name','like','%'.$value.'%')
                    ->orWhere('email','like','%'.$value.'%');
            });

    }

    /**
     * Force assignment to the 'basic-authenticated' permission
     *
     * Usually called from:
     *      RoleEventSubscriber@onRoleCreated
     *      RoleEventSubscriber@onRoleUpdated
     */
    public function postCreateAndUpdateFix()
    {
        Log::debug('Role.postCreateAndUpdateFix. ', ['role' => $this->name]);

        // Force assignment of the 'basic-authenticated' permission.
        $this->forcePermission('basic-authenticated');

        // Temporally disable the event dispatcher to avoid getting in an infinite loop of update events.
        $dispatcher = $this->getEventDispatcher();
        $this->unsetEventDispatcher();
        // Save changes.
        $this->save();
        // Restore event dispatcher.
        $this->setEventDispatcher($dispatcher);

    }

}
