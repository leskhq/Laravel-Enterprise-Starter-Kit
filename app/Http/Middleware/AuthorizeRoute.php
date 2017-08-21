<?php

namespace App\Http\Middleware;

use App\Exceptions\Handler;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Route as LaravelRoute;
use App\Models\Route as AppRoute;
use Log;

class AuthorizeRoute
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorized     = false;    // Default to protect all routes.
        $errorCode      = 0;        // Default to something bogus...
        $method         = null;
        $path           = null;
        $actionName     = null;
        $user           = null;
        $username       = null;
        $guest          = false;

        // Get current route from Laravel.
        $laravelRoute   = LaravelRoute::current();

        // If not set we will fallback to error HTTP 500. This should never occur. TODO: remove this check...
        if ( isset($laravelRoute) ) {
            // Get route info.
            $method     = $laravelRoute->methods()[0];
            $path       = $laravelRoute->uri();
            $actionName = $laravelRoute->getActionName();

            Log::debug("Authorizing method [" . $method . "], path [" . $path . "] and action name [" . $actionName . "].");


            // Get current user or set guest to true for unauthenticated users.
            if ( $this->auth->check() ) {
                $user       = $this->auth->user();
                $username   = $user->username;
                Log::debug("Authorizing user [" . $username . "].");
            } elseif ( $this->auth->guest() ) {
                $guest      = true;
                Log::debug("Authorizing user [GUEST].");
            }

//            // AuthController and PasswordController are exempt from authorization.
//            // TODO: Get list of controllers exempt from config.
//            if (str_contains($actionName, 'AuthController@') ||
//                str_contains($actionName, 'PasswordController@')
//            ) {
//                $authorized = true;
//            }
//            else

            // User is 'root', all is authorized.
            // TODO: Get super user name from config, and replace all occurrences.
            if (!$guest && isset($user) && 'root' == $user->username) {
                $authorized = true;
                Log::debug("Authorizing all for root user.");
            }
            // User has the role 'admins', all is authorized.
            // TODO: Get 'admins' role name from config, and replace all occurrences.
            elseif (!$guest && isset($user) && $user->hasRole('admins')) {
                $authorized = true;
                Log::debug("Authorizing all for role admins.");
            }
            else {
//                if ($user->enabled)
//                {
                // Get application route based on info from Laravel route.
                $appRoute = AppRoute::ofMethod($method)
                    ->ofActionName($actionName)
                    ->ofPath($path)
                    ->enabled()
                    ->with('permission')
                    ->first();
                // If found, proceed with authorization
                if ( isset($appRoute) ) {

                    // Permission set for route.
                    if ( isset($appRoute->permission) ) {
                        // Route is open to all.
                        // TODO: Get 'open-to-all' role name from config, and replace all occurrences.
                        if ( 'core.open-to-all' == $appRoute->permission->name ) {
                            $authorized = true;
                            Log::debug("Authorizing for route core.open-to-all.");
                        }
                        // TODO: Get 'guest-only' role name from config, and replace all occurrences.
                        // User is guest/unauthenticated and the route is restricted to guests.
                        elseif ( $guest && 'core.guest-only' == $appRoute->permission->name ) {
                            $authorized = true;
                            Log::debug("Authorizing for guest user and route core.guest-only.");
                        }
                        // TODO: Get 'basic-authenticated' role name from config, and replace all occurrences.
                        // The route is available to any authenticated user.
                        elseif ( !$guest && isset($user) && ($user->enabled) && 'core.basic-authenticated' == $appRoute->permission->name ) {
                            $authorized = true;
                            Log::debug("Authorizing for authenticated user and route core.basic-authenticated.");
                        }
                        // The user has the permission required by the route.
                        elseif ( !$guest && isset($user) && ($user->enabled) && $user->can($appRoute->permission->name) ) {
                            $authorized = true;
                            Log::debug("Authorizing for authenticated user having required permission [" . $appRoute->permission->name . "].");
                        }
                        // If all checks fail, abort with an HTTP 403 error.
                        else {
                            $errorCode = 403;
                            Log::error("Authorization denied for request path [" . $request->path() . "], method [" . $method . "] and action name [" . $actionName . "], guest [" . $guest . "], username [" . $username . "] requiring permission [" . $appRoute->permission->name . "].");
                        }
                    }
                    // If all checks fail, abort with an HTTP 403 error.
                    else {
                        $errorCode = 403;
                        Log::error("No permission set for the requested route, path [" . $request->path() . "], method [" . $method . "] and action name [" . $actionName . "], guest [" . $guest . "], username [" . $username . "].");
                    }
                }
                // If application route is not found
                else {
                    Log::error("No application route found in AuthorizeRoute module for request path [" . $request->path() . "], method [" . $method . "] and action name [" . $actionName . "].");
                    $errorCode = 403;
                } // if ( isset($appRoute) )
//                }
//                else
//                {
//                    return redirect( route('logout') );
//                }
            }
        }

        // If authorize, proceed
        if ($authorized) {
            return $next($request);
        // Else if error code was set abort with that.
        } elseif ( 0 != $errorCode ) {
            if ( !$guest && isset($user) && (!$user->enabled) ) {
                $msg = "User [" . $user->username . "] disabled, forcing logout.";
                Log::error($msg); // To LOG
//                (new Handler(Log::getMonolog()))->report(new \Exception($msg)); //To LERN
                return redirect( route('logout') );
            }
            else {
                $msg = "Aborting request with error code: " . $errorCode;
                Log::error($msg); // To LOG
//                (new Handler(Log::getMonolog()))->report(new \Exception($msg)); // To LERN
                abort($errorCode, $msg);
            }
        // Lastly Fallback to error HTTP 500: Internal server error. We should not get to this!
        } else {
            $msg = "Server error while trying to authorize route, request path [" . $request->path() . "], method [" . $method . "] and action name [" . $actionName . "].";
            Log::error($msg); // To LOG
//            (new Handler(Log::getMonolog()))->report(new \Exception($msg)); // To LERN
            abort(500, $msg);
        }
    }

}
