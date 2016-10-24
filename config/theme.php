<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Path to directory with themes
    |--------------------------------------------------------------------------
    |
    | The directory with your themes.
    |
    */
    'path'         => base_path('resources/themes'),

    /*
    |--------------------------------------------------------------------------
    | Path to directory with assets
    |--------------------------------------------------------------------------
    |
    | The directory with assets.
    |
    */
    'assets_path'  => 'assets/themes',

    /*
    |--------------------------------------------------------------------------
    | A pieces of theme collections
    |--------------------------------------------------------------------------
    |
    | Inside a theme path we need to set up directories to
    | keep "layouts", "assets" and "partials".
    |
    */
    'containerDir' => array(
        'layout'  => 'layouts',
        'partial' => 'partials',
        'view'    => 'views',
    ),

    /**
     * Default theme to use.
     */
    'default' => env('theme.default', 'default'),
);