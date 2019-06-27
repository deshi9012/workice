<?php

namespace Modules\Projects\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Projects\Entities\Project;

class BulkDeleteProjects implements ShouldQueue
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
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
        $this->userId = \Auth::id();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $projects = Project::whereIn('id', $this->arr)->get();
        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
