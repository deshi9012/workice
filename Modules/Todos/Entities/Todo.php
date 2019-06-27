<?php

namespace Modules\Todos\Entities;

use App\Traits\Actionable;
use App\Traits\BelongsToUser;
use App\Traits\Observable;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Todos\Entities\Todo;
use Modules\Todos\Events\TodoCreated;
use Modules\Todos\Events\TodoDeleted;
use Modules\Todos\Events\TodoUpdated;
use Modules\Todos\Observers\TodoObserver;
use Modules\Todos\Scopes\TodoScope;
use Modules\Users\Entities\User;

class Todo extends Model
{
    use SoftDeletes, Taggable, Observable, Actionable, BelongsToUser;

    protected static $observer = TodoObserver::class;
    protected static $scope    = TodoScope::class;

    protected $fillable = [
        'subject',
        'order',
        'parent',
        'due_date',
        'notes',
        'assignee',
        'reminded_at',
        'todoable_id',
        'todoable_type',
        'is_visible',
        'completed',
        'user_id',
    ];

    protected $table   = 'todo';
    protected $dates   = ['due_date'];
    protected $appends = ['todoable_url'];
    protected $casts   = [
        'parent' => 'integer',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TodoCreated::class,
        'updated' => TodoUpdated::class,
        'deleted' => TodoDeleted::class,
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'assignee', 'id');
    }

    public function child()
    {
        return $this->hasMany(Todo::class, 'parent')->orderBy('id', 'desc');
    }
    public function todoable()
    {
        return $this->morphTo();
    }

    public function progress()
    {
        if ($this->status === 'done') {
            return 100;
        }
        $subtasks = self::where('parent', $this->id)->get();
        $done     = $subtasks->where('status', 'done');
        if (count($subtasks) > 0) {
            return round((count($done) / count($subtasks)) * 100);
        }

        return 0;
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = dbDate($value);
    }
    public function scopeReminderAlerts($query)
    {
        return $query->where('due_date', '>=', now())->where('due_date', '<=', now()->addDays(config('system.alert_todo_before')))->whereNull('reminded_at');
    }
    public function scopePending($query)
    {
        return $query->where('completed', 0);
    }
    public function scopeDone($query)
    {
        return $query->where('completed', 1);
    }
    public function getTodoableUrlAttribute()
    {
        if ($this->todoable instanceof \Modules\Leads\Entities\Lead) {
            return route('leads.view', ['id' => $this->todoable_id]);
        }
        return route('deals.view', ['id' => $this->todoable_id]);
    }
}
