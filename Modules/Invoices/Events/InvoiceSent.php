<?php

namespace Modules\Invoices\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;

class InvoiceSent
{
    use SerializesModels;

    public $invoice;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, $user)
    {
        $this->invoice = $invoice;
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
