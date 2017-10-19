<?php

namespace App\Http\Middleware;

use App\Facades\Settings;
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

        if (class_exists('App\Managers\LeskSettingsManager')) {
            $walled_garden_enabled = Settings::get('walled-garden.enabled');
            $exemptionPath         = Settings::get('walled-garden.exemptions-path');
            $exemptionsRegEx       = Settings::get('walled-garden.exemptions-regex');
        } else {
            $walled_garden_enabled = config('walled-garden.enabled');
            $exemptionPath         = config('walled-garden.exemptions-path');
            $exemptionsRegEx       = config('walled-garden.exemptions-regex');
        }

        // Redirect to the login page if the user is not authenticated and the site
        // is configured as a walled garden, except if the request is going to a page
        // or route that is exempt from authentication.
        if ( $walled_garden_enabled ) {
            Log::debug("WalledGarden: Enabled: " . $walled_garden_enabled);
            $authenticated = $this->auth->check();
            Log::debug("WalledGarden: User authenticated: " . $authenticated);
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
                    Log::debug("WalledGarden: Path [". $requestPath ."], not exempt, redirecting to login.");
//                    $request->flashExcept(['password', 'password_confirmation']);
                    $request->session()->reflash();
                    return redirect()->guest('login');
                } else {
                    Log::debug("WalledGarden: Path [". $requestPath ."], exempt, allowing through.");
                }
            }
        }

        // Otherwise just continue on.
        return $next($request);
    }
}
