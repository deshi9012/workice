<?php

namespace Modules\Tickets\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Tickets\Entities\Ticket;
use App;
use Auth;

class BulkDeleteTickets implements ShouldQueue
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
        if (App::runningInConsole() && $this->user) {
            Auth::onceUsingId($this->user);
        }
        foreach (Ticket::whereIn('id', $this->arr)->get() as $ticket) {
            $ticket->delete();
        }
        if (App::runningInConsole() && $this->user) {
            Auth::logout();
        }
    }
}
