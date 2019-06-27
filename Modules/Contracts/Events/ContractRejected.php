<?php

namespace Modules\Contracts\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Contracts\Entities\Contract;

class ContractRejected
{
    use SerializesModels;

    public $contract;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contract $contract, $message)
    {
        $this->contract = $contract;
        $this->message = $message;
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
