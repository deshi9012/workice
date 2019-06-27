<?php

namespace Modules\Projects\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Projects\Entities\Project;

class FeedbackMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(langmail('projects.survey.subject'))
            ->from(get_option('company_email'), get_option('company_name'))
            ->markdown('emails.projects.survey');
    }
}
