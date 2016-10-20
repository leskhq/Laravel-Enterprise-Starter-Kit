<?php namespace App\Managers;

/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Foundation\Application;
use Setting;

class MenuBuilderManager
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function renderMenu( $topNode = 'root', $includeTopNode = false, $menuHandlerName = null )
    {
        $menuHandler = $this->instantiateHandler($menuHandlerName);

        // Call the render function and return the output.
        return $menuHandler->renderMenu($topNode, $includeTopNode);

    }

    public function renderBreadcrumbTrail( $leaf = null, $topNode = 'root', $includeTopNode = false, $menuHandlerName = null )
    {
        $menuHandler = $this->instantiateHandler($menuHandlerName);

        // Call the render function and return the output.
        return $menuHandler->renderBreadcrumbTrail($leaf, $topNode, $includeTopNode);

    }

    /**
     * @param $menuHandlerName
     * @return mixed
     */
    private function instantiateHandler($menuHandlerName = null)
    {
        // If no specific menu handler class name is specified, use the default as per the configuration.
        if (null == $menuHandlerName) {
            // Get the menu handler class name from the config.
            $menuHandlerName = Setting::get('menu-builder.framework_handler');

            // If the class name was resolved via ::class (PHP 5.5+)
            if (stripos($menuHandlerName, '::class') !== false) {
                $end = -1 * strlen('::class');
                $menuHandlerName = substr($menuHandlerName, 0, $end);
            }
        }


        // Instantiate the menuHandler and return it.
        $menuHandler = new $menuHandlerName($this->app);
        return $menuHandler;
    }

}
