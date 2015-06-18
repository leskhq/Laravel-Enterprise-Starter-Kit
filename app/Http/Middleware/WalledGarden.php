<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use Log;

class WalledGarden
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

        $walled_garden = env('WALLED_GARDEN', false);
        $authenticated = $this->auth->check();

        // Redirect to the login page if the user is not authenticated and the site
        // is configured as a walled garden, except if the request is already going
        // to the login page.
        if ( $walled_garden && !$authenticated && !$request->is('auth/login') )
        {
            return redirect()->guest('auth/login');
        }

        // Otherwise just continue on.
        return $next($request);
    }
}
