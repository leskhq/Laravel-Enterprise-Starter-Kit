<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laratrust\LaratrustRole;

class Role extends LaratrustRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
