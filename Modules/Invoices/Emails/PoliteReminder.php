<?php

namespace Modules\Invoices\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Invoices\Entities\Invoice;

class PoliteReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var Invoice
     */
    public $invoice;
    public $subject;
    public $message;
    public $module;
    public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct(Invoice $invoice, $subject = null, $message = null, $pdf = null)
    {
        $this->invoice = $invoice;
        $this->subject = $subject;
        $this->message = $message;
        $this->module = 'clients';
        $this->pdf = is_null($pdf) ? false : base64_encode($pdf);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = empty($this->subject) ? langmail('invoices.reminder.reminder1.subject', ['code' => $this->invoice->reference_no]) : $this->subject;
        if ($this->pdf) {
            $this->attachData(base64_decode($this->pdf), langapp('invoice') . ' ' . $this->invoice->reference_no . '.pdf');
        }
        return $this->subject($subject)
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.invoices.reminder');
    }
}
