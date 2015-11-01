<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Utils;

class Route extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'method', 'path', 'action_name', 'enabled'];


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

    /**
     * Load the Laravel routes into the application routes for
     * permission assignment.
     *
     * @return int  The number of Laravel routes loaded.
     */
    public static function loadLaravelRoutes()
    {
        $AppRoutes =  \Route::getRoutes();

        $cnt = 0;

        foreach ($AppRoutes as $appRoute)
        {
            $name       = $appRoute->getName();
            $methods    = $appRoute->getMethods();
            $path       = $appRoute->getPath();
            $actionName = $appRoute->getActionName();

            if (    !str_contains($actionName, 'AuthController')
                 && !str_contains($actionName, 'PasswordController') ) {

                foreach ($methods as $method) {
                    $route = null;

                    if (    'HEAD' !== $method                     // Skip method 'HEAD' looks to be duplicated of 'GET'
                         && !starts_with($path, '_debugbar')   ) { // Skip all DebugBar routes.

                        // TODO: Use Repository 'findWhere' when its fixed!!
                        //                    $route = $this->route->findWhere([
                        //                        'method'      => $method,
                        //                        'action_name' => $actionName,
                        //                    ])->first();
                        $route = \App\Models\Route::ofMethod($method)->ofActionName($actionName)->ofPath($path)->first();

                        if (!isset($route)) {
                            $cnt++;
                            $newRoute = Route::create([
                                'name'          => $name,
                                'method'        => $method,
                                'path'          => $path,
                                'action_name'   => $actionName,
                                'enabled'       => 1,
                            ]);
                        }
                    }
                }
            }
        }

        return $cnt;
    }


}
