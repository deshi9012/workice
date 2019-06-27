<?php

namespace Modules\Leads\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Messages\Entities\Emailing;

class LeadsBulkEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mail;
    public $signature;
    public $module;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Emailing $mail, $signature)
    {
        $this->mail      = $mail;
        $this->signature = $signature;
        $this->module    = 'leads';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mail->files->count() > 0) {
            foreach ($this->mail->files as $f) {
                $this->attach(storage_path('app/' . $f->path . '/' . $f->filename));
            }
        }
        return $this->subject($this->mail->subject)
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.leads.bulkemail');
    }
}
