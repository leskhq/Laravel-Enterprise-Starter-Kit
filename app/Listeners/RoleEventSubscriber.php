<?php

namespace App\Listeners;

use App\Events\RoleCreated;
use App\Events\RoleUpdated;
use App\Models\Role;
use Log;

class RoleEventSubscriber
{

    /**
     * @var Role
     */
    protected $role = null;

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
            'App\Events\RoleCreated',
            'App\Listeners\RoleEventSubscriber@onRoleCreated'
        );
        $events->listen(
            'App\Events\RoleUpdated',
            'App\Listeners\RoleEventSubscriber@onRoleUpdated'
        );

    }


    public function onRoleCreated(RoleCreated $event)
    {
        try {
            Log::debug("RoleEventSubscriber.onRoleCreated. ", ['name'=>$event->role->name]);
            $this->role = $event->role;
            $this->role->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function onRoleUpdated(RoleUpdated $event)
    {
        try {
            Log::debug("RoleEventSubscriber.onRoleUpdated. ", ['name'=>$event->role->name]);
            $this->role = $event->role;
            $this->role->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
