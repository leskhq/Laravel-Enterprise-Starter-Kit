<?php namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait UserHasPermissionsTrait
{
    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            if (!method_exists(Config::get('auth.model'), 'bootSoftDeletingTrait')) {
                // Repeat role->sync code attached from EntrustUserTrait::boot() as this boot()
                // function overwrites it.
                $user->roles()->sync([]);
                $user->permissions()->sync([]);
            }

            return true;
        });
    }

    /**
     * Many-to-Many relations with Permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Config::get('entrust.permission'), Config::get('entrust.permission_user_table'));
    }

    /**
     * Checks if the user has a permission by its name.
     *
     * @param string|array $name       Permission name or array of permission names.
     * @param bool         $requireAll All roles in the array are required.
     *
     * @return bool
     */
    public function hasPermission($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permName) {
                $hasPerm = $this->hasPermission($permName);

                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the permissions were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the permissions were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            // The 'root' user is all powerful.
            // TODO: Get super user name from config, and replace all occurrences.
            if ('root' == $this->username) {
                return true;
            }
            // Everyone has 'open-to-all'.
            // TODO: Get 'open-to-all' role name from config, and replace all occurrences.
            elseif ( 'open-to-all' == $name ) {
                return true;
            }
            // At this stage all users are authenticated so yes...
            elseif ( 'basic-authenticated' == $name ) {
                return true;
            }



            else {
                foreach ($this->permissions as $perm) {
                    if ($perm->name == $name) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    // TODO: Rewrite these with $user->permissions in mind!!
    /**
     * Code copy of EntrustUserTrait::can(...) with the one addition to check if a role
     * is enabled first the check if a permission is also enabled before
     * returning true.
     *
     * @param $permission
     * @param bool $requireAll
     * @return bool
     */
    public function canInRoles($permission, $requireAll = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->can($permName);

                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            // Users of the 'admin' role cab do it all.
            // TODO: Get 'admins' role name from config, and replace all occurrences.
            if ($this->hasRole('admins')) {
                return true;
            }
            else {
                foreach ($this->roles as $role) {
                    if ($role->enabled) {
                        // Validate against the Permission table
                        foreach ($role->perms as $perm) {
                            if ( ($perm->enabled) && ($perm->name == $permission) ) {
                                return true;
                            }
                        }
                    }
                }
            }

        }

        return false;
    }

    /**
     * Overwrites EntrustUserTrait::can(...), first checks if the permission(s) are
     * directly associated to the user model, using ->hasPermission(), then may if
     * required check if permission(s) are associated through the roles, using
     * ->canInRole().
     *
     * @param $permission
     * @param bool $requireAll
     * @return bool
     */
    public function can($permission, $requireAll = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->can($permName);

                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            if ($this->hasPermission($permission, false)) {
                return true;
            } else {
                if ($this->canInRoles($permission, false)) {
                    return true;
                }
            }
        }

        return false;
    }

    // TODO: Rewrite with $user->permissions in mind!!
//    /**
//     * Checks role(s) and permission(s).
//     *
//     * @param string|array $roles       Array of roles or comma separated string
//     * @param string|array $permissions Array of permissions or comma separated string.
//     * @param array        $options     validate_all (true|false) or return_type (boolean|array|both)
//     *
//     * @throws \InvalidArgumentException
//     *
//     * @return array|bool
//     */
//    public function ability($roles, $permissions, $options = [])
//    {
//        // Convert string to array if that's what is passed in.
//        if (!is_array($roles)) {
//            $roles = explode(',', $roles);
//        }
//        if (!is_array($permissions)) {
//            $permissions = explode(',', $permissions);
//        }
//
//        // Set up default values and validate options.
//        if (!isset($options['validate_all'])) {
//            $options['validate_all'] = false;
//        } else {
//            if ($options['validate_all'] !== true && $options['validate_all'] !== false) {
//                throw new InvalidArgumentException();
//            }
//        }
//        if (!isset($options['return_type'])) {
//            $options['return_type'] = 'boolean';
//        } else {
//            if ($options['return_type'] != 'boolean' &&
//                $options['return_type'] != 'array' &&
//                $options['return_type'] != 'both') {
//                throw new InvalidArgumentException();
//            }
//        }
//
//        // Loop through roles and permissions and check each.
//        $checkedRoles = [];
//        $checkedPermissions = [];
//        foreach ($roles as $role) {
//            $checkedRoles[$role] = $this->hasRole($role);
//        }
//        foreach ($permissions as $permission) {
//            $checkedPermissions[$permission] = $this->can($permission);
//        }
//
//        // If validate all and there is a false in either
//        // Check that if validate all, then there should not be any false.
//        // Check that if not validate all, there must be at least one true.
//        if(($options['validate_all'] && !(in_array(false,$checkedRoles) || in_array(false,$checkedPermissions))) ||
//            (!$options['validate_all'] && (in_array(true,$checkedRoles) || in_array(true,$checkedPermissions)))) {
//            $validateAll = true;
//        } else {
//            $validateAll = false;
//        }
//
//        // Return based on option
//        if ($options['return_type'] == 'boolean') {
//            return $validateAll;
//        } elseif ($options['return_type'] == 'array') {
//            return ['roles' => $checkedRoles, 'permissions' => $checkedPermissions];
//        } else {
//            return [$validateAll, ['roles' => $checkedRoles, 'permissions' => $checkedPermissions]];
//        }
//
//    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     */
    public function attachPermission($permission)
    {
        if(is_object($permission)) {
            $permission = $permission->getKey();
        }

        if(is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $permission
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);
    }

    /**
     * Attach multiple permissions to a user
     *
     * @param mixed $permissions
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Detach multiple permissions from a user
     *
     * @param mixed $permissions
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

}
