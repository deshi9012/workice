<?php

namespace Modules\Projects\Console;

use Illuminate\Console\Command;
use Modules\Projects\Entities\Project;
use Modules\Projects\Jobs\ComputeProject;

class CalculateProject extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'projects:balance {project?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates project summary.';

    /**
     * Project Model
     *
     * @var \Modules\Projects\Entities\Project
     */
    protected $project;

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
        $id = $this->argument('project');

        if ($id > 0) {
            $project = $this->project->findOrFail($id);
            $project->unsetEventDispatcher();
            $project->compute();
        } else {
            $this->project->whereNull('archived_at')->chunk(
                200,
                function ($projects) {
                    foreach ($projects as $project) {
                        $project->unsetEventDispatcher();
                        $project->compute();
                    }
                }
            );
        }
        $this->info('Project balances calculated successfully');
    }
}
