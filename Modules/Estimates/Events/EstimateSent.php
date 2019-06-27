<?php

namespace Modules\Estimates\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Entities\Estimate;

class EstimateSent
{
    use SerializesModels;

    public $estimate;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Estimate $estimate, $user)
    {
        $this->estimate = $estimate;
        $this->user = $user;
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
