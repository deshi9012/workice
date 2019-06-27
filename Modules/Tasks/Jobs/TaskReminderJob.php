<?php

namespace Modules\Tasks\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Notifications\TaskReminderAlert;
use Modules\Users\Entities\User;

class TaskReminderJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $tasks;
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
    public function __construct()
    {
        $this->tasks = Task::reminderAlerts()->get();
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function handle()
    {
        if (config('system.remind_overdue_tasks')) {
            $this->tasks->each(
            function ($task) {
                foreach (User::whereIn('id', $task->assignees)->get() as $user) {
                    $user->notify(new TaskReminderAlert($task));
                }
                $task->update(['reminded_at' => now()->toDateTimeString()]);
            }
        );
        }
    }
}
