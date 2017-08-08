<?php

namespace App\Listeners;

use App\Events\UserLogout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class LogUserLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLogout  $event
     * @return void
     */
    public function handle(UserLogout $event)
    {
        Log::info('[EVENT] -- User logout. ', ['username' => $event->user->username]);
    }
}
