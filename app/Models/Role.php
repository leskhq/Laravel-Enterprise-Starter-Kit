<?php namespace App\Models;

use App\Traits\BaseModelTrait;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    use BaseModelTrait;

    /**
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'resync_on_login', 'enabled'];


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

    public function hasPerm(Permission $perm)
    {
        // perm 'basic-authenticated' is always checked.
        if ('basic-authenticated' == $perm->name) {
            return true;
        }
        // Return true if the role has is assigned the given permission.
        if ($this->perms()->where('id', $perm->id)->first()) {
            return true;
        }
        // Otherwise
        return false;
    }

    /**
     * Force the role to have the given permission.
     *
     * @param $permissionName
     */
    public function forcePermission($permissionName)
    {
        // If the role has not been given a the said permission
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
