<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Events\UserDeleted;
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
            'App\Events\UserDeleted',
            'App\Listeners\UserEventSubscriber@onUserDeleted'
        );

    }


    public function onUserCreated(UserCreated $event)
    {
        try {
            Log::debug('UserEventSubscriber.onUserCreated', ['username' => $event->user->username]);
            $this->user = $event->user;
            $this->user->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function onUserUpdated(UserUpdated $event)
    {
        try {
            Log::debug('UserEventSubscriber.onUserUpdated', ['username' => $event->user->username]);
            $this->user = $event->user;
            $this->user->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function onUserDeleted(UserDeleted $event)
    {
        try {
            Log::debug('UserEventSubscriber.onUserDeleted', ['username' => $event->user->username]);
            $this->user = $event->user;
            $this->user->postDeleteFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
