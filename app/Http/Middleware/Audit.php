<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Jenssegers\Agent\Agent;
use App\Models\Audit as Auditor;
use Illuminate\Http\Request;
use Log;
use Route;
use Settings;

class Audit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userid  = null;
        $attJson = null;
        $audit_enabled = Settings::get('audit.enabled', false);

        if ($audit_enabled) {
            $agent = new Agent();

            if (Auth::check()) {
                $userid = Auth::user()->id;
            }

            // Get all attribute from the request.
            $attributes = $request->all();
            if (isset($attributes) && is_array($attributes)) {
                // Remove from array attributes that we do not want to save.
                unset($attributes['_method']);
                unset($attributes['_token']);
                unset($attributes['password']);
                unset($attributes['password_confirmation']);

                if ($attributes) {
                    $attJson = json_encode($attributes);
                }
            }

            $routeName = Route::currentRouteName();
            $routeAction = Route::getCurrentRoute()->getActionName();

            Log::debug("Audit: Login request for action: " . $routeAction);

            Auditor::create([
                'user_id' => $userid,
                'method' => $request->getMethod(),
                'path' => $request->getPathInfo(),
                'route_name' => $routeName,
                'route_action' => $routeAction,
                'query' => $request->getQueryString(),
                'data' => $attJson,
                'userAgent' => $agent->getUserAgent(),
                'ip' => \Request::ip(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'isDesktop' => $agent->isDesktop(),
                'isMobile' => $agent->isMobile(),
                'isPhone' => $agent->isPhone(),
                'isTablet' => $agent->isTablet()
            ]);
        }

        return $next($request);
    }
}