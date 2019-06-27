<?php

namespace Modules\Subscriptions\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Subscriptions\Entities\SubscriptionPlan;

class SendPlanMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $plan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SubscriptionPlan $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(langmail('subscriptions.sending.subject'))
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.subscriptions.send');
    }
}
