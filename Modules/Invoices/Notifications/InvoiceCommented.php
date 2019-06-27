<?php

namespace Modules\Invoices\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Invoices\Entities\Invoice;

class InvoiceCommented extends Notification implements ShouldQueue
{
    use Queueable;

    public $invoice;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->type    = 'invoice_commented';
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
                ->greeting(langmail('invoices.commented.greeting', ['name' => $notifiable->name]))
                ->line(langmail('invoices.commented.body', ['name' => $this->invoice->name]))
                ->action('View Invoice', route('invoices.view', $this->invoice->id));
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage)
                ->content(
                    langmail(
                        'invoices.commented.body',
                        [
                            'name' => $this->invoice->name,
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
                'subject'  => langmail('invoices.commented.subject'),
                'icon'     => 'comments',
                'activity' => langmail(
                    'invoices.commented.body',
                    [
                        'name' => $this->invoice->name,
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
                    'invoices.commented.body',
                    [
                        'name' => $this->invoice->name,
                    ]
                ));
        }
    }
}
