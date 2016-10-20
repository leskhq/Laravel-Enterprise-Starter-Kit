<?php namespace App\Providers;

/**
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 */

use App\Managers\SettingManager;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Bind to the key 'Setting' to a closure instantiating to the SettingManager.
        $this->app->bind('Setting', function($app) {
            return new SettingManager($app);
        });
    }

}
