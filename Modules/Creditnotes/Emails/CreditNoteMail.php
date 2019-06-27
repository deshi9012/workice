<?php

namespace Modules\Creditnotes\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Creditnotes\Entities\CreditNote;

class CreditNoteMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The creditnote model.
     *
     * @var \Modules\Creditnotes\Entities\CreditNote
     */
    public $creditnote;
    /**
     * Email subject
     */
    public $subject;
    public $message;
    public $module;
    public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct(CreditNote $creditnote, $subject = null, $message = null, $pdf = null)
    {
        $this->creditnote = $creditnote;
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
        $subject = empty($this->subject) ? langmail('credits.sending.subject', ['company' => get_option('company_name'), 'credit' => $this->creditnote->name]) : $this->subject;
        if ($this->pdf) {
            $this->attachData(base64_decode($this->pdf), langapp('credit_note') . ' ' . $this->creditnote->reference_no.'.pdf');
        }
        return $this->subject($subject)
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.credits.send_creditnote');
    }
}
