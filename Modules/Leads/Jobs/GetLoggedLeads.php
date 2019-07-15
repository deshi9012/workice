<?php

namespace Modules\Leads\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class FailedOrders implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct() {

//        $this->parcel = $parcel;
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     * @return void
     */
    public function failed(Error $error = null) {

    }
}
