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
use Illuminate\Database\Eloquent\Model;
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
        if (('admins' == $this->name) || ('users' == $this->name)) {
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

    // TODO: Is this needed??
//    public function hasPerm(Permission $perm)
//    {
//        // perm 'basic-authenticated' is always checked.
//        if ('basic-authenticated' == $perm->name) {
//            return true;
//        }
//        // Return true if the role has is assigned the given permission.
//        if ($this->perms()->where('id', $perm->id)->first()) {
//            return true;
//        }
//        // Otherwise
//        return false;
//    }

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

}
