<?php

namespace Modules\Estimates\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Entities\Estimate;

class ComputeEstimate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $estimate;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Estimate $estimate)
    {
        $this->estimate = $estimate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->estimate->unsetEventDispatcher();
        $this->estimate->compute();
    }
}
