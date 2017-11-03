<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ErrorsPurging
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $errorsToDelete;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Collection $errorsToDelete)
    {
        $this->errorsToDelete = $errorsToDelete;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('core-events');
    }
}
