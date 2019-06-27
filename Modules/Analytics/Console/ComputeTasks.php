<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Tasks\Entities\Task;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ComputeTasks extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate tasks reports.';

    /**
     * Task model
     *
     * @var \Modules\Tasks\Entities\Task
     */
    protected $task;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        parent::__construct();
        $this->task = $task;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->active();
        $this->done();
        $this->overdue();
        $this->avgProgress();
        $this->avgTime();
        $this->yearlyActive();
        $this->yearlyDone();
        $this->info('Task reports calculated successfully');
    }

    protected function active()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'tasks_active'],
            ['value' => $this->task->ongoing()->count()]
        );
    }
    protected function done()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'tasks_done'],
            ['value' => $this->task->completed()->count()]
        );
    }
    protected function overdue()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'tasks_overdue'],
            ['value' => $this->task->overdue()->count()]
        );
    }
    protected function avgProgress()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'tasks_average_progress'],
            ['value' => $this->task->avg('progress')]
        );
    }
    protected function avgTime()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'tasks_average_time'],
            ['value' => $this->task->where('time', '>', 0)->avg('time')]
        );
    }
    protected function yearlyDone()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'tasks_done_'.$i.'_'.$year],
                ['value' => $this->task->completed()->whereYear('created_at', $year)->whereMonth('created_at', $i)->count()]
            );
        }
    }
    protected function yearlyActive()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'tasks_active_'.$i.'_'.$year],
                ['value' => $this->task->ongoing()->whereYear('created_at', $year)->whereMonth('created_at', $i)->count()]
            );
        }
    }
}
