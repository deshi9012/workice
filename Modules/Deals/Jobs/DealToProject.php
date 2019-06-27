<?php

namespace Modules\Deals\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Deals\Entities\Deal;

class DealToProject
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $deal;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->deal->toProject();
    }
}
