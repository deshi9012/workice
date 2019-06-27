<?php

namespace Modules\Leads\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Leads\Entities\Lead;

class RequestConsent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;
    /**
     * Create a new message instance.
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lead Consent Email')
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.leads.consent');
    }
}
