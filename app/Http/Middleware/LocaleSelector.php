<?php

namespace App\Http\Middleware;

use App;
use App\Libraries\Utils;
use Closure;

class LocaleSelector
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
        $locale = Utils::getUserOrAppOrDefaultSetting('locale', 'app.locale', 'en');

        App::setLocale($locale);

        return $next($request);
    }
}
