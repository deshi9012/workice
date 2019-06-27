<?php

namespace Modules\Estimates\Events;

use Illuminate\Queue\SerializesModels;

class EstimateViewed
{
    use SerializesModels;

    public $estimate;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\Modules\Estimates\Entities\Estimate $estimate)
    {
        $this->estimate = $estimate;
        $this->user = \Auth::id() ?? 1;
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
