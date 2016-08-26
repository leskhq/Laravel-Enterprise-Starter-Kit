<?php namespace App\Providers;
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

use App\Managers\MenuBuilderManager;
use Illuminate\Support\ServiceProvider;

class MenuBuilderServiceProvider extends ServiceProvider
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
        // Bind to the key 'MenuBuilder' to a closure instantiating to the MenuBuilderManager.
        $this->app->bind('MenuBuilder', function($app) {
            return new MenuBuilderManager($app);
        });
    }

}
