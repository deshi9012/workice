<?php

namespace Modules\Estimates\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Estimates\Emails\EstimateMail;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Events\EstimateSent;

class BulkSendEstimates
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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

    protected $arr;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $arr, $user)
    {
        $this->arr  = $arr;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Estimate::whereIn('id', $this->arr)->get() as $estimate) {
            \Mail::to($estimate->company)->send(new EstimateMail($estimate));
            event(new EstimateSent($estimate, $this->user));
        }
    }
}
