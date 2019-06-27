<?php

namespace Modules\Knowledgebase\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Entities\User;

class ArticleCommented implements ShouldBroadcast
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = new User;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('workice-user-' . $this->user->id);
    }

    public function broadcastWith()
    {
        return [
            'user'    => [
                'name' => $this->user->name,
                'id'   => $this->user->id,
            ],
            'created' => dateElapsed(now()),
            'message' => $this->user->name . " commented on your article",
        ];
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'workice.event';
    }
}
