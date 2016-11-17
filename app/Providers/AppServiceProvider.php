<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        // Manually registering provider only if the environment is set to
//        // development. That prevents a loading failure in PROD when the
//        // package is not present.
//        if ($this->app->environment('development')) {
//            $this->app->register('Libern\SqlLogging\SqlLoggingServiceProvider');
//        }
    }
}
