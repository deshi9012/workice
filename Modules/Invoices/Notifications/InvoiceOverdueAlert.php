<?php

namespace Modules\Invoices\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Invoices\Entities\Invoice;

class InvoiceOverdueAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack', 'mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(langmail('invoices.expiring.greeting', ['name' => $notifiable->name]))
            ->subject(langmail('invoices.expiring.subject', ['company' => get_option('company_name'), 'days' => now()->diffInDays($this->invoice->due_date)]))
            ->line(
                langmail(
                    'invoices.expiring.body',
                    [
                        'code' => $this->invoice->reference_no,
                        'date' => dateTimeFormatted($this->invoice->created_at),
                        'days' => now()->diffInDays($this->invoice->due_date),
                    ]
                )
            )
            ->action('Review invoice', \URL::signedRoute('invoices.guest', $this->invoice->id))
            ->line(langmail('invoices.expiring.footer'));
    }

    /*
    Send slack notification
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content(
                langmail(
                    'invoices.expiring.body',
                    [
                        'code' => $this->invoice->reference_no,
                        'date' => dateTimeFormatted($this->invoice->created_at),
                        'days' => now()->diffInDays($this->invoice->due_date),
                    ]
                )
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject'  => langmail('invoices.expiring.subject', ['company' => get_option('company_name'), 'days' => now()->diffInDays($this->invoice->due_date)]),
            'icon'     => 'exclamation-triangle',
            'activity' => langmail(
                'invoices.expiring.body',
                [
                    'code' => $this->invoice->reference_no,
                    'date' => dateTimeFormatted($this->invoice->created_at),
                    'days' => now()->diffInDays($this->invoice->due_date),
                ]
            ),
        ];
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content(langmail(
                'invoices.expiring.subject',
                [
                    'company' => get_option('company_name'),
                    'days'    => now()->diffInDays($this->invoice->due_date),
                ]
            ));
    }
}
