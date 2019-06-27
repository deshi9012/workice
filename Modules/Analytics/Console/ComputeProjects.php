<?php

namespace Modules\Analytics\Console;

use Illuminate\Console\Command;
use Modules\Projects\Entities\Project;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ComputeProjects extends Command
{
    protected $project;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'analytics:projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to calculate project reports.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->project = new Project;
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
        $this->avgBudget();
        $this->avgBillable();
        $this->avgExpenses();
        $this->calcQuaters();
        $this->info('Projects reports calculated successfully');
    }

    protected function active()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'projects_active'],
            ['value' => $this->project->active()->count()]
        );
    }
    protected function done()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'projects_done'],
            ['value' => $this->project->done()->count()]
        );
    }
    protected function avgBudget()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'projects_average_budget'],
            ['value' => $this->project->avg('used_budget')]
        );
    }
    protected function avgBillable()
    {
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'projects_average_billable'],
            ['value' => $this->project->avg('billable_time')]
        );
    }

    protected function avgExpenses()
    {
        $amount = 0;
        $this->project->chunk(
            200, function ($projects) use (&$amount) {
                foreach ($projects as $key => $project) {
                    if ($project->currency != get_option('default_currency')) {
                        $amount += convertCurrency($project->currency, $project->total_expenses);
                    } else {
                        $amount += $project->total_expenses;
                    }
                };
            }
        );
        \App\Entities\Computed::updateOrCreate(
            ['key' => 'projects_average_expenses'],
            ['value' => $amount]
        );
    }

    protected function calcQuaters()
    {
        $year = chartYear();
        for ($i = 1; $i < 13; $i++) {
            \App\Entities\Computed::updateOrCreate(
                ['key' => 'projects_done_'.$i.'_'.$year],
                ['value' => $this->project->whereYear('start_date', $year)->whereMonth('start_date', $i)->done()->count()]
            );
        }
    }
}
