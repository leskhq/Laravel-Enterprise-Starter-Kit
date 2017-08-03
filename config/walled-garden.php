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

    'enabled' => env('WALLED_GARDEN.ENABLED', false),


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
        'register',         'faust',
        'login',            'logout',
        'password/email',   'password/reset',
    ],


    /*
    |--------------------------------------------------------------------------
    | Path to exempt from the walled garden based on Regular Expression
    |--------------------------------------------------------------------------
    |
    | Paths that should be exempt from the walled garden based on Regular
    | Expressions.
    |
    */
    'exemptions-regex' => [
        '/password\/reset\/.*/',
    ],

);