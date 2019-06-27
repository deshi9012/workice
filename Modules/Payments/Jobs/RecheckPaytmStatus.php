<?php

namespace Modules\Payments\Jobs;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Payments\Jobs\RecheckPaytmStatus;

class RecheckPaytmStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Obtain transaction status / information
     *
     * @return Object
     */
    public function handle()
    {
        $status = PaytmWallet::with('status');
        $status->prepare(['order' => $this->orderId]);
        $status->check();
        $response = $status->response();
        if ($status->isSuccessful()) {
            $payment = (new \Modules\Payments\Helpers\PaymentEngine('paytm', $response))->transact();
        }
    }
}
