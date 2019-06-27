<?php

namespace Modules\Users\Notifications;

use App\Entities\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class AnnouncementAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $announcement;
    public $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
        $this->type         = 'announcement_alert';
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
            return $notifiable->notifyOn($this->type, ['slack', 'database', 'mail']);
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
                ->subject(langmail('announcements.alert.subject', ['subject' => $this->announcement->subject]))
                ->markdown('emails.announcements.alert', ['announcement' => $this->announcement]);
        }
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'announcements.alert.body',
                        [
                            'message' => $this->announcement->message,
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
                'subject'  => langmail('announcements.alert.subject', ['subject' => $this->announcement->subject]),
                'icon'     => 'bullhorn',
                'activity' => langmail(
                    'announcements.alert.body',
                    [
                        'message' => $this->announcement->message,
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
                ->content('A new announcement has been sent to your email by ' . get_option('company_name'));
        }
    }
}
