<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Enabled
    |--------------------------------------------------------------------------
    |
    | The walled garden functionality is disabled by default, to enabled it set
    | the variable 'WALLED_GARDEN_ENABLED' to true in your '.env' file.
    |
    */

    'enabled' => env('WALLED_GARDEN_ENABLED', false),


    /*
    |--------------------------------------------------------------------------
    | Path to exempt from the walled garden
    |--------------------------------------------------------------------------
    |
    | List of path to exempt from the walled garden. To allow users to login,
    | register, recover passwords or debug.
    |
    */
    'exemptions-path' => [
        '/',                'home',                             'faust',
        'auth/login',       'auth/register',
        'password/email',   'password/reset',
        '_debugbar/open',   '_debugbar/assets/stylesheets',    '_debugbar/assets/javascript',
    ],


    /*
    |--------------------------------------------------------------------------
    | Path to exempt from the walled garden based on Regular Expression
    |--------------------------------------------------------------------------
    |
    | Paths that should be exempt from the walled garden based on Regular
    | Expressios.
    |
    */
    'exemptions-regex' => [
        '/password\/reset\/.*/',
    ],

);