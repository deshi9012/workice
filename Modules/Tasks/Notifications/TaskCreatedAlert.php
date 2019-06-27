<?php

namespace Modules\Tasks\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Tasks\Entities\Task;

class TaskCreatedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->type = 'task_created';
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
                ->greeting(langmail('tasks.created.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('tasks.created.subject'))
                ->line(langmail('tasks.created.body', ['name' => $this->task->name]))
                ->action('View Task', route('projects.view', ['id' => $this->task->AsProject->id, 'tab' => 'tasks', 'item' => $this->task->id]));
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'tasks.created.body',
                        [
                            'name' => $this->task->name,
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
                'subject'  => langmail('tasks.created.subject'),
                'icon'     => 'check-cirle',
                'activity' => langmail(
                    'tasks.created.body',
                    [
                        'name' => $this->task->name,
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
                    'tasks.created.body',
                    [
                        'name' => $this->task->name,
                    ]
                ));
        }
    }
}
