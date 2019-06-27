<?php

namespace Modules\Users\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Entities\User;

class UserDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auth;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
