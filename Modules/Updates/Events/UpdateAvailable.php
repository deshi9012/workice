<?php

namespace Modules\Updates\Events;

use Illuminate\Queue\SerializesModels;

class UpdateAvailable
{
    use SerializesModels;

    public $latest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($latest)
    {
        $this->latest = $latest;
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
