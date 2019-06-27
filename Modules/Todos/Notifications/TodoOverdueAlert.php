<?php

namespace Modules\Todos\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Todos\Entities\Todo;

class TodoOverdueAlert extends Notification implements ShouldQueue
{
    use Queueable;
    public $todo;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
        $this->type = 'todo_reminder_alert';
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
                ->greeting(langmail('todos.expiring.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('todos.expiring.subject'))
                ->line(
                    langmail(
                        'todos.expiring.body',
                        [
                            'subject' => $this->todo->subject,
                            'date'    => dateTimeFormatted($this->todo->due_date),
                        ]
                    )
                )
                ->action('Preview Task', url('/'));
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
                        'todos.expiring.body',
                        [
                            'subject' => $this->todo->subject,
                            'date'    => dateTimeFormatted($this->todo->due_date),
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
                'subject'  => langmail('todos.expiring.subject'),
                'icon'     => 'tasks',
                'activity' => langmail(
                    'todos.expiring.body',
                    [
                        'subject' => $this->todo->subject,
                        'date'    => dateTimeFormatted($this->todo->due_date),
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
                    'todos.expiring.body',
                    [
                        'subject' => $this->todo->subject,
                        'date'    => dateTimeFormatted($this->todo->due_date),
                    ]
                ));
        }
    }
}
