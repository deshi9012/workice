<?php

namespace Modules\Estimates\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Entities\Estimate;

class EstimateInvoiced
{
    use SerializesModels;
    public $estimate;
    public $user_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Estimate $estimate, $user_id)
    {
        $this->estimate = $estimate;
        $this->user_id = $user_id;
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
