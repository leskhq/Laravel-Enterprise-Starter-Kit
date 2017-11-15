<?php

namespace App\Providers;

use App\Managers\LeskSettingsManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('lesk.settings.manager', function(Application $app) {
            return new LeskSettingsManager($app);
        });
    }
}
