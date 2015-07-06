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
        // TODO: Get theme from user settings or system setting, or env or default....
        Theme::init(env('DEFAULT_THEME', 'default'));

        return $next($request);
    }
}
