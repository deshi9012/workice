<?php

namespace Modules\Contracts\Events;

use Illuminate\Queue\SerializesModels;

class ClauseUpdated
{
    use SerializesModels;
    
    public $clause;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\Modules\Contracts\Entities\Clause $clause)
    {
        $this->clause = $clause;
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
