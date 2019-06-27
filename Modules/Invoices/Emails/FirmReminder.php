<?php

namespace Modules\Invoices\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;

class FirmReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var Invoice
     */
    public $invoice;
    public $module;
    /**
     * Create a new message instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->module = 'clients';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(langmail('invoices.reminder.reminder2.subject', ['code' => $this->invoice->reference_no]))
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.invoices.reminder2');
    }
}
