<?php

namespace Modules\Issues\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Issues\Entities\Issue;

class IssueChangedAlert extends Notification implements ShouldQueue
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
        $this->type  = 'issue_changed_alert';
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
            return $notifiable->notifyOn($this->type, ['slack', 'database']);
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
                ->greeting(langmail('issues.changed.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('issues.changed.subject', ['code' => $this->issue->code, 'subject' => $this->issue->subject]))
                ->line(langmail('issues.changed.body', ['code' => $this->issue->code, 'subject' => $this->issue->subject]))
                ->action('View Issue', route('projects.view', ['id' => $this->issue->AsProject->id, 'tab' => 'issues', 'item' => $this->issue->id]));
        }
    }
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'issues.changed.body',
                        [
                            'code'    => $this->issue->code,
                            'subject' => $this->issue->subject,
                        ]
                    )
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
                'subject'  => langmail('issues.changed.subject', ['code' => $this->issue->code, 'subject' => $this->issue->subject]),
                'icon'     => 'pencil-alt',
                'activity' => langmail(
                    'issues.changed.body',
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
                    'issues.changed.body',
                    [
                        'code'    => $this->issue->code,
                        'subject' => $this->issue->subject,
                    ]
                ));
        }
    }
}
