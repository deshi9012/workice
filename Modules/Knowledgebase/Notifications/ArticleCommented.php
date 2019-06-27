<?php

namespace Modules\Knowledgebase\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Knowledgebase\Entities\Knowledgebase;

class ArticleCommented extends Notification implements ShouldQueue
{
    use Queueable;

    public $article;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Knowledgebase $article)
    {
        $this->article = $article;
        $this->type    = 'article_commented';
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
                ->greeting(langmail('knowledgebase.commented.greeting', ['name' => $notifiable->name]))
                ->line(
                    langmail(
                        'knowledgebase.commented.body',
                        [
                            'subject' => $this->article->subject,
                        ]
                    )
                )
                ->action('View Article', route('kb.view', $this->article->id));
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
                        'knowledgebase.commented.body',
                        [
                            'subject' => $this->article->subject,
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
                'subject'  => langmail('knowledgebase.commented.subject'),
                'icon'     => 'comments',
                'activity' => langmail(
                    'knowledgebase.commented.body',
                    [
                        'subject' => $this->article->subject,
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
                    'knowledgebase.commented.body',
                    [
                        'subject' => $this->article->subject,
                    ]
                ));
        }
    }
}
