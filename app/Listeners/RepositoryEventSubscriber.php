<?php

namespace App\Listeners;

use Illuminate\Database\Eloquent\Model;
use Log;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Events\RepositoryEventBase;

class RepositoryEventSubscriber
{

    /**
     * @var RepositoryInterface
     */
    protected $repository = null;

    /**
     * @var Model
     */
    protected $model = null;

    /**
     * @var action
     */
    protected $action = null;

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
     * Handle the Repository entity created event.
     *
     * @param  RepositoryEventBase  $event
     * @return void
     */
    public function onEntityCreated(RepositoryEventBase $event)
    {
        try {

            $this->repository = $event->getRepository();
            $this->model = $event->getModel();
            $this->action = $event->GetAction();

            Log::debug("Repository entity created: " . get_class($this->model));
            switch (get_class($this->model))
            {
                case 'App\Models\User':
                    $this->model->postCreateFix();
                    break;
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the Repository entity created event.
     *
     * @param  RepositoryEventBase  $event
     * @return void
     */
    public function onEntityUpdated(RepositoryEventBase $event)
    {
        try {

            $this->repository = $event->getRepository();
            $this->model = $event->getModel();
            $this->action = $event->GetAction();

            Log::debug("Repository entity updated: " . get_class($this->model));
            switch (get_class($this->model))
            {
                case 'App\Models\User':
                    $this->model->postUpdateFix();
                    break;
            }

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
            'Prettus\Repository\Events\RepositoryEntityCreated',
            'App\Listeners\RepositoryEventSubscriber@onEntityCreated'
        );

        $events->listen(
            'Prettus\Repository\Events\RepositoryEntityUpdated',
            'App\Listeners\RepositoryEventSubscriber@onEntityUpdated'
        );

    }

}
