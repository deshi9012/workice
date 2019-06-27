<?php

namespace Modules\Estimates\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Entities\Estimate;

class EstimateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $estimate;
    public $subject;
    public $message;
    public $module;
    public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct(Estimate $estimate, $subject = null, $message = null, $pdf = null)
    {
        $this->estimate = $estimate;
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
        $subject = empty($this->subject) ? langmail('estimates.sending.subject', ['company' => get_option('company_name'), 'estimate' => $this->estimate->name]) : $this->subject;
        if ($this->pdf) {
            $this->attachData(base64_decode($this->pdf), langapp('estimate') . ' ' . $this->estimate->reference_no.'.pdf');
        }
        return $this->subject($subject)
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.estimates.send_estimate');
    }
}
