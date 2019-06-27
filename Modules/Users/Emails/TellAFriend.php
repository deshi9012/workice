<?php

namespace Modules\Users\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TellAFriend extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $friend;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($friend, $name)
    {
        $this->friend = $friend;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('company_email'))
            ->subject('Invitation by '.$this->name)
            ->markdown('emails.tell_friend');
    }
}
