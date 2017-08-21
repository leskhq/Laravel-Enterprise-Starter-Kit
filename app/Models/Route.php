<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Route extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'method', 'path', 'action_name', 'enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * Establish the BelongsTo association to a Permission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }

//    /**
//     * Establish the hasMany association to Menus
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function menus()
//    {
//        return $this->hasMany('App\Models\Menu');
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

    public static function returnTrue()
    {
        return true;
    }

    /**
     * Load the Laravel routes into the application routes for
     * permission assignment.
     *
     * @param $routeNameRegEx
     *
     * @return int The number of Laravel routes loaded.
     */
    public static function loadLaravelRoutes($routeNameRegEx)
    {
        $AppRoutes = \Route::getRoutes();

        $cnt = 0;

        foreach ($AppRoutes as $appRoute) {

            $name = $appRoute->getName();
            $methods = $appRoute->methods();
            $path = $appRoute->uri();
            $actionName = $appRoute->getActionName();

            // Skip AuthController and PasswordController routes, Those are always authorized.
            if (!str_contains($actionName, 'AuthController')
                && !str_contains($actionName, 'PasswordController')
            ) {

                // Include only if the name matches the requested Regular Expression.
                if (preg_match($routeNameRegEx, $name)) {
                    foreach ($methods as $method) {
                        $route = null;

                        if ('HEAD' !== $method                     // Skip method 'HEAD' looks to be duplicated of 'GET'
                            && !starts_with($path, '_debugbar')
                        ) { // Skip all DebugBar routes.

                            $route = \App\Models\Route::ofMethod($method)->ofActionName($actionName)->ofPath($path)->first();

                            if (!isset($route)) {
                                $cnt++;
                                \App\Models\Route::create([
                                    'name' => $name,
                                    'method' => $method,
                                    'path' => $path,
                                    'action_name' => $actionName,
                                    'enabled' => 1,
                                ]);
                            }
                        }
                    }

                }
            }
        }

        return $cnt;
    }


    public static function deleteLaravelRoutes()
    {
        $laravelRoutes = \Route::getRoutes();
        $dbRoutes = \App\Models\Route::all();
        $dbRoutesToDelete = [];
        $cnt = 0;

        foreach( $dbRoutes as $dbRoute) {
            $dbRouteActionName = $dbRoute->action_name;

            $laravelRoute = null;
            // Try to find by action
            $laravelRoute = $laravelRoutes->getByAction($dbRouteActionName);
            // Try to find by name
            if (null == $laravelRoute) {
                $dbRouteName = $dbRoute->name;
                $laravelRoute = $laravelRoutes->getByName($dbRouteName);
            }
            // Laravel route not found, add to list to delete.
            if (null == $laravelRoute) {
                $dbRoutesToDelete[]= $dbRoute->id;
            }
        }

        if ( ($cnt = count($dbRoutesToDelete)) > 0) {
            \App\Models\Route::destroy($dbRoutesToDelete);
        }

        return $cnt;
    }

}
