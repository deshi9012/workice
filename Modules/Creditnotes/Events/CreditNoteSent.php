<?php

namespace Modules\Creditnotes\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Creditnotes\Entities\CreditNote;

class CreditNoteSent
{
    use SerializesModels;

    public $credit;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CreditNote $credit, $user)
    {
        $this->credit = $credit;
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
