<?php

namespace App\Listeners;

use App\Events\PermissionCreated;
use App\Events\PermissionUpdated;
use App\Events\UserCreated;
use App\Events\UserUpdated;
use App\Models\Permission;
use Log;

class PermissionEventSubscriber
{

    /**
     * @var Permission
     */
    protected $permission = null;

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
            'App\Events\PermissionCreated',
            'App\Listeners\PermissionEventSubscriber@onPermissionCreated'
        );
        $events->listen(
            'App\Events\PermissionUpdated',
            'App\Listeners\PermissionEventSubscriber@onPermissionUpdated'
        );

    }


    public function onPermissionCreated(PermissionCreated $event)
    {
        try {
            Log::debug("PermissionEventSubscriber.onPermissionCreated. ", ['name'=>$event->permission->name]);
            $this->permission = $event->permission;
            $this->permission->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function onPermissionUpdated(PermissionUpdated $event)
    {
        try {
            Log::debug("PermissionEventSubscriber.onPermissionUpdated. ", ['name'=>$event->permission->name]);
            $this->permission = $event->permission;
            $this->permission->postCreateAndUpdateFix();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
