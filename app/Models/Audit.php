<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'method', 'path', 'route_name', 'route_action', 'query', 'data', 'userAgent', 'ip', 'device' , 'platform', 'browser' , 'isDesktop', 'isMobile' , 'isPhone' , 'isTablet'
    ];


    public function user ()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get online users
     *
     * @param int $min
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function online ($min = 3)
    {

        return $this->select('user_id')
            ->where('audits.created_at', '>=', Carbon::now()->subMinutes($min)->toDateTimeString())
            ->distinct('user_id')
            ->with('user')
            ->get()->map(function ($item) {
                return $item->user;
            });

    }

    public function scopeFreesearch($query, $value)
    {
        // search against multiple fields using OR
        return $query->where('method','like','%'.$value.'%')
            ->orWhere('path','like','%'.$value.'%')
            ->orWhere('route_name','like','%'.$value.'%')
            ->orWhere('route_action','like','%'.$value.'%')
            ->orWhere('query','like','%'.$value.'%')
            ->orWhere('data','like','%'.$value.'%')
            ->orWhere('userAgent','like','%'.$value.'%')
            ->orWhere('ip','like','%'.$value.'%')
            ->orWhere('device','like','%'.$value.'%')
            ->orWhere('platform','like','%'.$value.'%')
            ->orWhere('browser','like','%'.$value.'%')
            // Look into assigned roles
            ->orWhereHas('user', function ($q) use ($value) {
                $q->where('username','like','%'.$value.'%')
                    ->orWhere('first_name','like','%'.$value.'%')
                    ->orWhere('last_name','like','%'.$value.'%')
                    ->orWhere('email','like','%'.$value.'%');
            });

    }


}