<?php

namespace App\Facades;

/**
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 */

use Illuminate\Support\Facades\Facade;

class SettingFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Setting';
    }
}
