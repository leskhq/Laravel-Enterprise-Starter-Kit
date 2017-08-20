<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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

}
