<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserLogin' => [
            'App\Listeners\LogUserLogin',
        ],
        'App\Events\UserLogout' => [
            'App\Listeners\LogUserLogout',
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\LogUserRegistered',
        ],
        'App\Events\UserResetPassword' => [
            'App\Listeners\LogUserResetPassword',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
