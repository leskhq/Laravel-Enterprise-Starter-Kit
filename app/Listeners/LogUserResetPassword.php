<?php

namespace App\Listeners;

use App\Events\UserResetPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class LogUserResetPassword
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
     * @param  UserResetPassword  $event
     * @return void
     */
    public function handle(UserResetPassword $event)
    {
        Log::info('[EVENT] -- User reset password. ', ['username' => $event->user->username]);
    }
}
