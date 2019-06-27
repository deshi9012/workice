<?php

namespace Modules\Webhook\Notifications;

use App\Entities\AcceptPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentMissingAlert extends Notification
{
    use Queueable;

    public $payload;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $method = AcceptPayment::where('method_id', $this->payload['payment_method'])->first()->method_name;
        return (new MailMessage)
            ->greeting('Hey '.$notifiable->name)
            ->subject('Payment Check')
            ->line('A payment via '.$method.' for amount '.$this->payload['amount'].' is missing. Please check it manually')
            ->action('Preview Invoice', route('invoices.view', $this->payload['invoice_id']))
            ->line('Thanks');
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
            //
        ];
    }
}
