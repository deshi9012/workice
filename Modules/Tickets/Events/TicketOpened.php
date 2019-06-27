<?php

namespace Modules\Tickets\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Tickets\Entities\Ticket;

class TicketOpened
{
    use SerializesModels;

    public $ticket;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, $user)
    {
        $this->ticket = $ticket;
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
