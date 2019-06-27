<?php

namespace Modules\Timetracking\Entities;

use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Observable;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Entities\Task;
use Modules\Timetracking\Events\TimerCreated;
use Modules\Timetracking\Events\TimerDeleted;
use Modules\Timetracking\Events\TimerUpdated;
use Modules\Timetracking\Observers\TimerObserver;
use Modules\Timetracking\Scopes\TimeEntryScope;

class TimeEntry extends Model
{
    use BelongsToUser, SoftDeletes, Observable, Actionable, Searchable;

    protected static $observer = TimerObserver::class;
    protected static $scope    = TimeEntryScope::class;

    protected $fillable = [
        'id', 'timeable_type', 'timeable_id', 'user_id', 'task_id', 'start', 'end', 'billable', 'total', 'notes',
        'is_started', 'started_by', 'billed', 'archived_at', 'created_at',
    ];
    protected $appends = ['worked', 'url'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TimerCreated::class,
        'updated' => TimerUpdated::class,
        'deleted' => TimerDeleted::class,
    ];

    public function timeable()
    {
        return $this->morphTo();
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function incrementTimer($sec)
    {
        return Carbon::createFromTimestamp($this->start)->addSeconds($sec);
    }

    public function getWorkedAttribute()
    {
        if ($this->total > 0) {
            return $this->total;
        }

        return $this->end > 0 ? $this->end - $this->start : 0;
    }

    public function getUrlAttribute()
    {
        if ($this->task_id > 0) {
            return route('projects.view', ['id' => $this->timeable->id, 'tab' => 'tasks', 'item' => $this->task_id]);
        }
        return route('projects.view', ['id' => $this->timeable->id]);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = empty($value) ? \Auth::id() : $value;
    }

    public function scopeStopped($query)
    {
        return $query->whereIsStarted(0);
    }

    public function scopeBilled($query)
    {
        return $query->whereBilled(1);
    }

    public function scopeUnbilled($query)
    {
        return $query->whereBilled(0);
    }

    public function scopeBillable($query)
    {
        return $query->whereBillable(1);
    }
    public function scopeUnBillable($query)
    {
        return $query->whereBillable(0);
    }

    public function scopeRunning($query)
    {
        return $query->whereIsStarted(1);
    }
}
