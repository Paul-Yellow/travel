<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserFollow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $targetUser;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $targetUser, string $type)
    {
        $this->user = auth()->user();
        $this->targetUser = $targetUser;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
