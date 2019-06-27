<?php

namespace Modules\Contracts\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Contracts\Entities\Contract;

class ContractReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $contract;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('company_email'), get_option('company_name'))
            ->subject(langmail('contracts.reminder.subject', ['title' => $this->contract->contract_title]))
            ->markdown('emails.contracts.reminder');
    }
}
