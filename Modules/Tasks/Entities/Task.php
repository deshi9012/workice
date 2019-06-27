<?php

namespace Modules\Tasks\Entities;

use App\Entities\Category;
use App\Traits\Actionable;
use App\Traits\Assignable;
use App\Traits\BelongsToUser;
use App\Traits\Commentable;
use App\Traits\Eventable;
use App\Traits\Observable;
use App\Traits\Recurrable;
use App\Traits\Remindable;
use App\Traits\Searchable;
use App\Traits\Taggable;
use App\Traits\Todoable;
use App\Traits\Uploadable;
use App\Traits\Vaultable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Milestones\Entities\Milestone;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Events\TaskCreated;
use Modules\Tasks\Events\TaskDeleted;
use Modules\Tasks\Events\TaskUpdated;
use Modules\Tasks\Jobs\ComputeTask;
use Modules\Tasks\Notifications\TaskCommented;
use Modules\Tasks\Notifications\TaskCreatedAlert;
use Modules\Tasks\Observers\TaskObserver;
use Modules\Tasks\Scopes\TaskScope;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Entities\QuickAccess;

class Task extends Model
{
    use SoftDeletes, BelongsToUser, Actionable, Taggable, Vaultable, Todoable, Recurrable,
    Commentable, Assignable, Observable, Uploadable, Eventable, Remindable, Searchable;

    protected static $observer = TaskObserver::class;
    protected static $scope    = TaskScope::class;

    protected $fillable = [
        'name', 'project_id', 'milestone_id', 'description', 'visible', 'progress', 'estimated_hours', 'auto_progress',
        'start_date', 'due_date', 'user_id', 'stage_id', 'reminded_at', 'hourly_rate', 'time', 'archived_at',
        'is_recurring', 'created_at',
    ];

    protected $dates   = ['start_date', 'due_date'];
    protected $appends = ['est_price'];
    protected $casts   = [
        'is_recurring' => 'integer',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
        'updated' => TaskUpdated::class,
        'deleted' => TaskDeleted::class,
    ];

    public function AsProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function AsMilestone()
    {
        return $this->belongsTo(Milestone::class, 'milestone_id');
    }

    public function sidebars()
    {
        return $this->hasMany(QuickAccess::class, 'task_id')->where('user_id', \Auth::id());
    }

    public function AsCategory()
    {
        return $this->belongsTo(Category::class, 'stage_id');
    }

    public function timesheets()
    {
        return $this->hasMany(TimeEntry::class, 'task_id')->orderByDesc('id');
    }

    public function commentAlert($comment)
    {
        $members = $this->assignees->filter(
            function ($member) {
                return $member->user_id != \Auth::id();
            }
        );
        \Notification::send($members->pluck('user'), new TaskCommented($this));
        $this->user->notify(new TaskCommented($this)); // Notify task creator
    }

    public function notifyTeam()
    {
        $members = $this->assignees->filter(
            function ($member) {
                return $member->user_id != \Auth::id();
            }
        );
        \Notification::send($members->pluck('user'), new TaskCreatedAlert($this));
    }

    // public function hoursWorked()
    // {
    //     $res = TimeEntry::where(['task_id' => $this->t_id, 'is_billable' => 1, 'is_started' => 0])->get();
    //     $sum = 0;
    //     foreach ($res as $key => $t) {
    //         $sum += $t->loggedTime();
    //         // $sum += TimeEntry::findOrFail($t->timer_id)->loggedTime();
    //     }

    //     return $sum;
    // }
    // public function stopTimer($timer_id)
    // {
    //     $timer = TimeEntry::find($timer_id);
    //     if ($timer->started_by != auth()->id || !can('full_control')) {
    //         log_message('error', langapp('timer_not_allowed'));
    //     }
    //     $project_logged_time = $this->totalHours();
    //     $time_logged         = (time() - $timer->begin_time) + $project_logged_time;

    //     $data = array('is_started' => 0, 'log_time' => $time_logged);
    //     $this->update($data);

    //     $data = ['project_id' => $this->project_id,
    //         'begin_time'          => $timer->begin_time,
    //         'user'                => auth()->id,
    //         'end_time'            => time(),
    //     ];
    //     TimeEntry::create($data);

    //     return true;
    // }

    // // Calculate task spent hours
    // public function timeUsed($billable = true)
    // {
    //     $billable = ($billable) ? '1' : '0';
    //     $res = $this->timesheets()->where(['task_id' => $this->t_id, 'is_billable' => $billable, 'is_started' => 0])->get();
    //     $sum = 0;
    //     foreach ($res as $key => $t) {
    //         $sum += $t->loggedTime();
    //     }

    //     return $sum;
    // }

    public function isOverdue()
    {
        if (strtotime($this->due_date) < time() && $this->progress < 100) {
            return true;
        }

        return false;
    }

    public function recur()
    {
        $recurDays = request('recurring.frequency');
        $nextDate  = nextRecurringDate(today(), $recurDays);
        $this->update(['is_recurring' => 1]);
        return $this->recurring()->updateOrCreate(
            ['recurrable_id' => $this->id],
            [
                'next_recur_date' => $nextDate,
                'recur_starts'    => dbDate(request('recurring.recur_starts')),
                'recur_ends'      => dbDate(request('recurring.recur_ends')),
                'frequency'       => $recurDays,
            ]
        );
    }

    public function recurred()
    {
        $this->update(
            [
                'is_recurring' => 0,
                'time'         => 0,
                'reminded_at'  => null,
                'start_date'   => now()->toDateTimeString(),
                'due_date'     => now()->addDays(config('system.task_due_after')),
            ]
        );
    }

    public function stopRecurring()
    {
        if ($this->is_recurring === 1) {
            $this->update(['is_recurring' => 0]);
            return $this->recurring->delete();
        }
    }

    public function startComputeJob()
    {
        return ComputeTask::dispatch($this)->onQueue('high');
    }
    public function compute()
    {
        $this->update(
            [
                'time' => $this->billable(),
            ]
        );
    }
    public function billable()
    {
        $total = 0;
        foreach ($this->timesheets()->billable()->unbilled()->get() as $time) {
            $total += $time->worked;
        }
        return $total;
    }

    public function timerRunning()
    {
        return $this->timesheets()->running()->count();
    }

    public function addSidebar()
    {
        if (QuickAccess::where(['task_id' => $this->id, 'user_id' => \Auth::id()])->count() > 0) {
            QuickAccess::where(['task_id' => $this->id, 'user_id' => \Auth::id()])->delete();
        } else {
            $this->sidebars()->updateOrCreate(
                ['user_id' => \Auth::id(), 'task_id' => $this->id],
                ['project_id' => null]
            );
        }
    }

    public function startClock()
    {
        $entry = $this->AsProject->timesheets()->running()->whereUserId(\Auth::id());
        if ($entry->count() === 0) {
            $this->AsProject->timesheets()->create(
                [
                    'task_id'    => $this->id,
                    'is_started' => 1,
                    'user_id'    => \Auth::id(),
                    'started_by' => \Auth::id(),
                    'start'      => time(),
                ]
            );

            return true;
        }
        return false;
    }

    public function stopClock()
    {
        $timer = $this->timesheets()->whereUserId(\Auth::id())->running()->first();
        if (!isset($timer->id)) {
            return false;
        }
        return $timer->update(['end' => time(), 'is_started' => 0, 'started_by' => 0]);
    }

    public function overdueTasks()
    {
        return self::whereDate('due_date', '<', today()->toDateString())
            ->whereNull('reminded_at')
            ->where('progress', '<', 100)
            ->get();
    }

    // public function isPinned()
    // {
    //     return \QuickAccess::where(['user_id' => \Auth::user()->id, 'task_id' => $this->t_id])->count();
    // }

    // Calculate total tasks hours
    public function totalTime($time = 0)
    {
        $entries = $this->timesheets()->billable()->stopped()->get();
        foreach ($entries as $key => $entry) {
            $time += $entry->worked;
        }
        return formatDecimal($time);
    }

    public function unbilled($time = 0)
    {
        $entries = $this->timesheets()->billable()->stopped()->unbilled()->get();
        foreach ($entries as $key => $entry) {
            $time += $entry->worked;
        }
        return formatDecimal($time);
    }

    public function isTeam($user = 0)
    {
        return $this->assignees()->where('user_id', $user > 0 ? $user : \Auth::id())->count();
    }

    public function scopeOngoing($query)
    {
        return $query->where('progress', '>', 0)->where('progress', '<', 100);
    }

    public function scopeCompleted($query)
    {
        return $query->where('progress', '>=', 100);
    }
    public function scopeTemplates($query)
    {
        return $query->whereProjectId(0);
    }

    public function scopeOverdue($query)
    {
        return $query->whereDate('due_date', '<', now())->where('progress', '<', 100);
    }

    public function scopeReminderAlerts($query)
    {
        return $query->where('progress', '<', 100)->whereDate('due_date', '>=', now())->whereDate('due_date', '<=', now()->addDays(config('system.alert_todo_before')))->whereNull('reminded_at');
    }

    public function scopeBacklog($query)
    {
        return $query->whereProgress(0);
    }

    public function scopeMine($query)
    {
        return $query->whereHas(
            'assignees',
            function ($query) {
                $query->where(
                    [
                        'user_id' => \Auth::id(),
                    ]
                );
            }
        );
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = dbDate($value);
    }
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id() ?? $value;
    }

    public function getUnbilledAttribute()
    {
        return $this->unbilled();
    }

    public function getEstPriceAttribute()
    {
        return formatCurrency($this->AsProject->currency, $this->hourly_rate * $this->estimated_hours);
    }
    public function getUrlAttribute()
    {
        return '/projects/view/' . $this->AsProject->id . '/tasks/' . $this->id;
    }
}
