<?php

namespace App\Facades;

/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @package Sroutier\MenuBuilder
 */

use Illuminate\Support\Facades\Facade;

class MenuBuilderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MenuBuilder';
    }
}
