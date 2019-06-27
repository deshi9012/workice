<?php

namespace Modules\Creditnotes\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Creditnotes\Entities\CreditNote;

class CalculateCredits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $credit;
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
    public function __construct(CreditNote $credit)
    {
        $this->credit = $credit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->credit->unsetEventDispatcher();
        $this->credit->compute();
    }
}
