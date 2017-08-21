<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Events\UserLogin;
use App\Events\UserLogout;
use App\Events\UserRegistered;
use App\Events\UserResetPassword;
use App\Events\UserUpdated;
use App\Models\User;
use Log;

class UserEventSubscriber
{

    /**
     * @var User
     */
    protected $user = null;

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
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * Handle the User created event.
     *
     * @param UserCreated $event
     * @return void
     */
    public function onUserCreated(UserCreated $event)
    {
        try {

            $this->user = $event->user;
            $this->user->postCreateFix();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the User updated event.
     *
     * @param UserUpdated $event
     * @return void
     */
    public function onUserUpdated(UserUpdated $event)
    {
        try {

            $this->user = $event->user;
            $this->user->postUpdateFix();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the User login event.
     *
     * @param UserLogin $event
     * @return void
     */
    public function onUserLogin(UserLogin $event)
    {
        try {

            Log::info('[EVENT] -- User login. ', ['username' => $event->user->username]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the User logout event.
     *
     * @param UserLogout $event
     * @return void
     */
    public function onUserLogout(UserLogout $event)
    {
        try {

            Log::info('[EVENT] -- User logout. ', ['username' => $event->user->username]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the User registered event.
     *
     * @param UserRegistered $event
     * @return void
     */
    public function onUserRegistered(UserRegistered $event)
    {
        try {

            Log::info('[EVENT] -- User registered. ', ['username' => $event->user->username]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the User reset password event.
     *
     * @param UserResetPassword $event
     * @return void
     */
    public function onUserResetPassword(UserResetPassword $event)
    {
        try {

            Log::info('[EVENT] -- User reset password. ', ['username' => $event->user->username]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'App\Events\UserCreated',
            'App\Listeners\UserEventSubscriber@onUserCreated'
        );
        $events->listen(
            'App\Events\UserUpdated',
            'App\Listeners\UserEventSubscriber@onUserUpdated'
        );
        $events->listen(
            'App\Events\UserLogin',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );
        $events->listen(
            'App\Events\UserLogout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
        $events->listen(
            'App\Events\UserRegistered',
            'App\Listeners\UserEventSubscriber@onUserRegistered'
        );
        $events->listen(
            'App\Events\UserResetPassword',
            'App\Listeners\UserEventSubscriber@onUserResetPassword'
        );

    }

}
