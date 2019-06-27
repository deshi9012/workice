<?php

namespace Modules\Projects\Jobs;

use App;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Projects\Entities\Project;

class BulkInvoiceProjects implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
        $this->arr  = $arr;
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

        $projects = Project::whereIn('id', $this->arr)->get();
        foreach ($projects as $project) {
            $project->makeInvoice('task_line');
            $project->compute();
        }
        if (App::runningInConsole() && $this->user) {
            Auth::logout();
        }
    }
}
