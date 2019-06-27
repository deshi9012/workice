<?php

namespace Modules\Deals\Events;

use Illuminate\Queue\SerializesModels;

class DealLost
{
    use SerializesModels;

    public $deal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\Modules\Deals\Entities\Deal $deal)
    {
        $this->deal = $deal;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
