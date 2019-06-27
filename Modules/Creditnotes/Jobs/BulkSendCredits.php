<?php

namespace Modules\Creditnotes\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Creditnotes\Emails\CreditNoteMail;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Creditnotes\Events\CreditNoteSent;

class BulkSendCredits
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
        $this->arr = $arr;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (CreditNote::whereIn('id', $this->arr)->get() as $credit) {
            \Mail::to($credit->company)->send(new CreditNoteMail($credit));
            event(new CreditNoteSent($credit, $this->user));
        }
    }
}
