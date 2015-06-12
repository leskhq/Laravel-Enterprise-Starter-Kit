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
        Theme::init('default');

        return $next($request);
    }
}
