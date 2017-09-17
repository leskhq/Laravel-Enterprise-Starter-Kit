<?php

return [

    /* -----------------------------------------------------------------
     |  Default drivers
     | -----------------------------------------------------------------
     | Supported: 'array', 'json', 'database', 'redis'
     */

    'default' => 'json',

    /* -----------------------------------------------------------------
     |  Drivers
     | -----------------------------------------------------------------
     */

    'drivers' => [

        'array' => [
            'driver'  => Arcanedev\LaravelSettings\Stores\ArrayStore::class,
        ],

        'json' => [
            'driver'  => Arcanedev\LaravelSettings\Stores\JsonStore::class,

            'options' => [
                'path'   => storage_path('app/settings.json'),
            ],
        ],

        'database' => [
            'driver'  => Arcanedev\LaravelSettings\Stores\DatabaseStore::class,

            'options' => [
                'connection' => null,
                'table'      => 'settings',
                'model'      => \Arcanedev\LaravelSettings\Models\Setting::class,
            ],
        ],

        'redis' => [
            'driver'  => Arcanedev\LaravelSettings\Stores\RedisStore::class,

            'options' => [
                'client' => 'predis',

                'default' => [
                    'host'     => env('REDIS_HOST', '127.0.0.1'),
                    'port'     => env('REDIS_PORT', 6379),
                    'database' => env('REDIS_DB', 0),
                ],
            ],
        ],
    ],

];
