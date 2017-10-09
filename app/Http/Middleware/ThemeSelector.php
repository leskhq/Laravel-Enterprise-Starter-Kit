<?php

namespace App\Http\Middleware;

use Closure;
use Theme;

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
        $themeName = 'default';
        if (\Auth::check()) {
            $themeName = \Auth::user()->settings()->get('theme.default', 'default');
        } else {
            $themeName = \Settings::get('theme.default', 'default');
        }

        Theme::init($themeName);

        return $next($request);
    }

}
