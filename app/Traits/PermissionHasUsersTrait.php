<?php namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait PermissionHasUsersTrait
{

    /**
     * Boot the permission model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the permission model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($permission) {
            if (!method_exists(Config::get('entrust.permission'), 'bootSoftDeletingTrait')) {
                // Repeat role->sync code attached from EntrustPermissionTrait::boot() as this boot()
                // function overwrites it.
                $permission->roles()->sync([]);
                $permission->users()->sync([]);
            }

            return true;
        });
    }

    /**
     * Many-to-Many relations with user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.model', 'App\User'), Config::get('app.permission_user_table'));
    }

    /**
     * @param $userName
     *
     * @return bool
     */
    public function hasUser($userName)
    {
        foreach($this->users as $user)
        {
            if($user->username == $userName)
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getIsUsedByUserAttribute()
    {
        return ($this->users->count() > 0);
    }


}
