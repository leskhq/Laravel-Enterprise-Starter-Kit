<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait as EntrustUserTrait;
use App\models\Permission;
use App\models\Role;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use EntrustUserTrait {
        can as traitCan;
        hasRole as traitHasRole;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

//    // TODO: Do we need this??
//    /**
//     * @return mixed
//     */
//    public function getLevelMax()
//    {
//        $roles = [];
//        foreach($this->roles as $role)
//        {
//            $roles[] = $role->level;
//        }
//
//        return max($roles);
//    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the root user from edits.
        if ('root' == $this->username) {
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
            $roleToForce = Role::where('name', $roleName)->first();
            $this->roles()->attach($roleToForce->id);
        }
    }

    /**
     * Code copy of EntrustUserTrait::hasRole(...) with the one addition to check if a role
     * is enabled before returning true.
     *
     * @param $name
     * @param bool $requireAll
     * @return bool
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->roles as $role) {
                if ( ($role->enabled) && ($role->name == $name) ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Code copy of EntrustUserTrait::can(...) with the one addition to check if a role
     * is enabled first the check if a permission is also enabled before
     * returning true.
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

        return false;
    }



}
