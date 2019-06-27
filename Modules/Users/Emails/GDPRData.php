<?php

namespace Modules\Users\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Entities\User;

class GDPRData extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('company_email'))
            ->subject('Your Data with '.get_option('company_name'))
            ->attach(
                storage_path('app/tmp/user_'.$this->user->id.'_data.zip'), [
                        'as' => 'GDPR_DATA_'.$this->user->id.'_'.time().'.zip',
                    ]
            )
            ->markdown('emails.gdpr');
    }
}
