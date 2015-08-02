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
        $exempt = false;

        $walled_garden = env('WALLED_GARDEN', false);

        // TODO: Get these arrays from config.
        $exemptionPath = [
            '/',                'home',                             'faust',
            'auth/login',       'auth/register',
            'password/email',   'password/reset',
            '_debugbar/open',   '_debugbar/assets/stylesheets',    '_debugbar/assets/javascript',
        ];
        $exemptionsRegEx = [
            '/password\/reset\/.*/',
                            ];

        // Redirect to the login page if the user is not authenticated and the site
        // is configured as a walled garden, except if the request is going to a page
        // or route that is exempt from authentication.
        if ( $walled_garden )
        {
            $authenticated = $this->auth->check();
            if (!$authenticated) {
                $requestURI = $request->getUri();
                $requestPath = $request->path();

                foreach ($exemptionPath as $exPath) {
                    if ($exPath == $requestPath) {
                        $exempt = true;
                        break;
                    }
                }
                if (!$exempt) {
                    foreach ($exemptionsRegEx as $regEx) {
                        if (preg_match($regEx, $requestPath)) {
                            $exempt = true;
                            break;
                        }
                    }
                }
                if (!$exempt) {
                    return redirect()->guest('auth/login');
                }
            }
        }

        // Otherwise just continue on.
        return $next($request);
    }
}
