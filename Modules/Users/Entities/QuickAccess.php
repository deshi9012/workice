<?php

namespace Modules\Users\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;

class QuickAccess extends Model
{
    use BelongsToUser;

    protected $guarded = [];
    protected $table = 'quick_access';
    protected $appends = ['url', 'name', 'progress'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function getNameAttribute()
    {
        return $this->task_id <= 0 ? $this->project->name : $this->task->name;
    }
    public function getUrlAttribute()
    {
        return $this->task_id <= 0 ? route('projects.view', ['id' => $this->project_id]) : route('projects.view', ['id' => $this->task->project_id, 'tab' => 'tasks', 'item' => $this->task_id]);
    }
    public function getProgressAttribute()
    {
        return $this->task_id <= 0 ? $this->project->progress : $this->task->progress;
    }
}
