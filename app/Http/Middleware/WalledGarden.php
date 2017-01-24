<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Setting;

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

        $walled_garden_enabled = Setting::get('walled-garden.enabled');
        $exemptionPath         = Setting::get('walled-garden.exemptions-path');
        $exemptionsRegEx       = Setting::get('walled-garden.exemptions-regex');

        // Redirect to the login page if the user is not authenticated and the site
        // is configured as a walled garden, except if the request is going to a page
        // or route that is exempt from authentication.
        if ( $walled_garden_enabled ) {
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
//                    $request->flashExcept(['password', 'password_confirmation']);
                    $request->session()->reflash();
                    return redirect()->guest('auth/login');
                }
            }
        }

        // Otherwise just continue on.
        return $next($request);
    }
}
