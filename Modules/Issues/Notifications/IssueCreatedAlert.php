<?php

namespace Modules\Issues\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Issues\Entities\Issue;

class IssueCreatedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $issue;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
        $this->type  = 'issue_created_alert';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable->notificationActive($this->type)) {
            return $notifiable->notifyOn($this->type, ['slack', 'mail']);
        }
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type)) {
            return (new MailMessage)
                ->greeting(langmail('issues.created.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('issues.created.subject', ['code' => $this->issue->code, 'subject' => $this->issue->subject]))
                ->line(langmail('issues.created.body', ['code' => $this->issue->code, 'subject' => $this->issue->subject]))
                ->action('View Issue', route('projects.view', ['id' => $this->issue->AsProject->id, 'tab' => 'issues', 'item' => $this->issue->id]));
        }
    }
    /**
     * Send slack notification
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->success()
                ->content(langmail('issues.created.body', ['code' => $this->issue->code, 'subject' => $this->issue->subject]))
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->issue->subject, route('projects.view', ['id' => $this->issue->AsProject->id, 'tab' => 'issues', 'item' => $this->issue->id]))
                            ->fields(
                                [
                                    langapp('code')     => $this->issue->code,
                                    langapp('project')  => $this->issue->AsProject->name,
                                    langapp('priority') => $this->issue->priority,
                                    langapp('status')   => $this->issue->AsStatus->status,
                                ]
                            );
                    }
                );
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($notifiable->channelActive('database', $this->type)) {
            return [
                'subject'  => langmail('issues.created.subject', ['code' => $this->issue->code, 'subject' => $this->issue->subject]),
                'icon'     => 'exclamation-triangle',
                'activity' => langmail(
                    'issues.created.body',
                    [
                        'code'    => $this->issue->code,
                        'subject' => $this->issue->subject,
                    ]
                ),
            ];
        }
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        if ($notifiable->channelActive('nexmo', $this->type)) {
            return (new NexmoMessage)
                ->content(langmail(
                    'issues.created.body',
                    [
                        'code'    => $this->issue->code,
                        'subject' => $this->issue->subject,
                    ]
                ));
        }
    }
}
