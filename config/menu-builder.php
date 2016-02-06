<?php
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @package Sroutier\MenuBuilder
 */

return array(

    /*
    |--------------------------------------------------------------------------
    | Framework handler
    |--------------------------------------------------------------------------
    |
    | The class that helps built the HTML/CSS for the chosen framework.
    |
    */

    'framework_handler' => env('MENU_BUILDER_FRAMEWORK_HANDLER', 'App\Handlers\L51ESKSecuredMenuHandler'),

);

