<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Theme;
use Auth;

class ThemeSelector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $themeName = null;

        // If user is logged in, try to get his theme.
        if (Auth::check()) {
            $themeName = Setting::get('user.' . Auth::user()->id . '.theme');
        }
        // If no theme resolved, try to get the system theme, or the default.
        if (null == $themeName) {
            $themeName = Setting::get('theme.default', 'default');
        }

        Theme::init( $themeName );

        return $next($request);
    }
}
