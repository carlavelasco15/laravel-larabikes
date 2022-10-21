<?php

namespace App\Events;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FirstBikeCreated
{
    use Dispatchable, SerializesModels;

    public $bike, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bike $bike, User $user)
    {
        $this->bike = $bike;
        $this->user = $user;
    }
}
