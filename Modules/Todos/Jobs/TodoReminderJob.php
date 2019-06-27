<?php

namespace Modules\Todos\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Todos\Entities\Todo;
use Modules\Todos\Notifications\TodoOverdueAlert;

class TodoReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;
    
    public $todos;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->todos = Todo::reminderAlerts()->get();
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        $this->todos->each(
            function ($todo) {
                $todo->agent->notify(new TodoOverdueAlert($todo));
                $todo->update(['reminded_at' => now()->toDateTimeString()]);
            }
        );
    }
}
