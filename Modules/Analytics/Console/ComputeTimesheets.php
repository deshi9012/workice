<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Timetracking\Entities\TimeEntry;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ComputeTimesheets extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:timesheets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate timesheet reports.';

    /**
     * Time entry model
     *
     * @var \Modules\Timetracking\Entities\TimeEntry
     */
    protected $timer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TimeEntry $timer)
    {
        parent::__construct();
        $this->timer = $timer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->total();
        $this->today();
        $this->thisWeek();
        $this->billable();
        $this->unbillable();
        $this->billed();
        $this->unbilled();
        $this->yearlyBilled();
        $this->yearlyWorked();
        $this->info('Timesheet reports calculated successfully');
    }

    protected function total()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_worked'],
            ['value' => $this->timer->sum('total')]
        );
    }

    protected function billable()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_billable'],
            ['value' => $this->timer->billable()->sum('total')]
        );
    }
    protected function today()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_today'],
            ['value' => $this->timer->whereDate('created_at', today())->sum('total')]
        );
    }

    protected function thisWeek()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_this_week'],
            ['value' => $this->timer->whereBetween('created_at', [now()->startOfWeek(),now()->endOfWeek()])->sum('total')]
        );
    }

    protected function unbillable()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_unbillable'],
            ['value' => $this->timer->unbillable()->sum('total')]
        );
    }
    protected function billed()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_billed'],
            ['value' => $this->timer->billed()->sum('total')]
        );
    }
    protected function unbilled()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'time_unbilled'],
            ['value' => $this->timer->unbilled()->sum('total')]
        );
    }
    protected function yearlyWorked()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'time_worked_'.$i.'_'.$year],
                ['value' => $this->timer->whereYear('created_at', $year)->whereMonth('created_at', (string)$i)->sum('total')]
            );
        }
    }
    protected function yearlyBilled()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'time_worked_billed_'.$i.'_'.$year],
                ['value' => $this->timer->whereYear('created_at', $year)->whereMonth('created_at', (string)$i)->billed()->sum('total')]
            );
        }
    }
}
