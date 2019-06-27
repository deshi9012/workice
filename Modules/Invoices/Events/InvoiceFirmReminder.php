<?php

namespace Modules\Invoices\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;

class InvoiceFirmReminder
{
    use SerializesModels;

    public $invoice;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
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
