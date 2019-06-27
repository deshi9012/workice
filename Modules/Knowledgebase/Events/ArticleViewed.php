<?php

namespace Modules\Knowledgebase\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Knowledgebase\Entities\Knowledgebase;

class ArticleViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $kb;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Knowledgebase $kb)
    {
        $this->kb = $kb;
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
