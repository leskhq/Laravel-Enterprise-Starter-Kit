<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Utils;

class Route extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'method', 'path', 'action_name'];


    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }
//    /**
//     * @return string
//     */
//    public function getUniqueRoutePathAttribute($value)
//    {
//        return Route::makeUniqueRoutePath($this->method, $this->action_name);
//    }
//
//    /**
//     * @param $method
//     * @param $action_name
//     * @return string
//     */
//    public static function makeUniqueRoutePath($method, $action_name)
//    {
//        return $method . ":" . $action_name;
//    }

    public function scopeOfMethod($query, $method)
    {
        return $query->where('method', $method);
    }

    public function scopeOfActionName($query, $actionName)
    {
        return $query->where('action_name', $actionName);
    }

    public function scopeOfPath($query, $path)
    {
        return $query->where('path', $path);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeDisabled($query)
    {
        return $query->where('enabled', false);
    }

}
