<?php

namespace Modules\Projects\Console;

use Illuminate\Console\Command;
use Modules\Projects\Entities\Project;
use Modules\Projects\Notifications\ProjectOverbudget;

class Overbudget extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'projects:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor overbudget in projects.';

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
        $this->project->active()->whereNull('overbudget_at')->chunk(
            200,
            function ($projects) {
                foreach ($projects as $project) {
                    if ($project->used_budget > config('system.budget_exceeds')) {
                        $project->unsetEventDispatcher();
                        \Notification::send($project->assignees()->get()->pluck('user'), new ProjectOverbudget($project));
                        $project->update(['overbudget_at' => now()->toDateTimeString()]);
                    }
                }
            }
        );
    }
}
