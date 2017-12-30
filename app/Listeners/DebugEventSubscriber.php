<?php

namespace App\Listeners;

use App\Models\User;
use Log;

class DebugEventSubscriber
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
            '*',
            'App\Listeners\DebugEventSubscriber@logEvents'
        );
    }


    public function logEvents($event)
    {
        try {
            if ("Illuminate\Log\Events\MessageLogged" != $event) {
                Log::debug('LOGGED EVENT', ['event' => $event]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
