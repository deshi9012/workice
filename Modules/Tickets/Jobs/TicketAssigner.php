<?php

namespace Modules\Tickets\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Notifications\TicketAssigned;
use Modules\Users\Entities\User;
use Modules\Users\Entities\UserHasDepartment;

class TicketAssigner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    public $ticket;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->ticket->assignee <= 0) {
            $users = UserHasDepartment::where('department_id', $this->ticket->dept->deptid)->select('user_id', 'department_id')->whereHas(
                'user',
                function ($query) {
                    $query->where('on_holiday', 0);
                }
            )->get()->toArray();
            $this->ticket->unsetEventDispatcher();
            $this->ticket->update(['assignee' => count($users) > 0 ? array_random($users)['user_id'] : User::role('admin')->inRandomOrder()->first()->id]);
            $this->ticket->agent->notify(new TicketAssigned($this->ticket));
        }
    }
}
