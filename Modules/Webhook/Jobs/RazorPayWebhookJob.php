<?php

namespace Modules\Webhook\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Payments\Entities\Payment;
use Modules\Users\Entities\User;
use Modules\Webhook\Notifications\PaymentMissingAlert;

class RazorPayWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;
    
    protected $payload;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment = Payment::where($this->payload)->count();
        if ($payment == 0) {
            $user = User::role('admin')->first();
            $user->notify(new PaymentMissingAlert($this->payload));
        }
    }
}
