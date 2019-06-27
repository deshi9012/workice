<?php

namespace Modules\Calendar\Notifications;

use App\Entities\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ReminderAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $reminder;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
        $this->type     = 'reminder_alert';
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

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content('Reminder: **' . $this->reminder->description . '**');
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type) && $this->reminder->send_email) {
            return (new MailMessage)
                ->line('Reminder: ')
                ->line('**' . $this->reminder->description . '**');
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
                'subject'  => 'Reminder Alert',
                'icon'     => 'stopwatch',
                'activity' => 'Reminder for **' . $this->reminder->description . '**',
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
                ->content('Reminder for **' . $this->reminder->description . '**');
        }
    }
}
