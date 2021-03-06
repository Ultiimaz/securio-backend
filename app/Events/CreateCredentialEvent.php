<?php

namespace App\Events;

use App\Broadcasting\AdministrationChannel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateCredentialEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param $credential
     */
    public function __construct($credential)
    {
        //

    }



    public function broadcastOn()
    {
        return new PrivateChannel(AdministrationChannel::class);
    }
}
