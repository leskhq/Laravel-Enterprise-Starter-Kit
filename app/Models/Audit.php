<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Audit
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $method
 * @property string|null $path
 * @property string|null $route_name
 * @property string|null $route_action
 * @property string|null $query
 * @property string|null $data
 * @property string|null $userAgent
 * @property string|null $ip
 * @property string|null $device
 * @property string|null $platform
 * @property string|null $browser
 * @property int|null $isDesktop
 * @property int|null $isMobile
 * @property int|null $isPhone
 * @property int|null $isTablet
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit freesearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereIsDesktop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereIsMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereIsPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereIsTablet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereRouteAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereRouteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $category
 * @property string|null $message
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Audit whereMessage($value)
 */
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