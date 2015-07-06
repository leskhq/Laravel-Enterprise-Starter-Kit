<?php namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {

    /**
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];


    public function routes()
    {
        return $this->hasMany('App\Models\Route');
    }

    /**
     * @param $roleName
     *
     * @return bool
     */
    public function hasRole($roleName)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $roleName)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $value
     * @return bool
     */
    public function getIsUsedByRoleAttribute()
    {
        return ($this->roles->count() > 0);
    }

    /**
     * @param $value
     * @return bool
     */
    public function getIsUsedByRouteAttribute()
    {
        return ($this->routes->count() > 0);
    }

    /**
     * @param $value
     * @return bool
     */
    public function getIsUsedAttribute()
    {
        return ($this->is_used_by_role || $this->is_used_by_route);
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the guest-only and basic-authenticated permissions from edits.
        if ( ('guest-only' == $this->name) ||
             ('basic-authenticated' == $this->name)) {
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
        // Protect the guest-only and basic-authenticated permissions from deletion.
        if ( ('guest-only' == $this->name) ||
             ('basic-authenticated' == $this->name) ||
             ($this->is_used) ) {
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


}
