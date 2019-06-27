<?php

namespace Modules\Calendar\Entities;

use App\Scopes\OwnerScope;
use App\Traits\BelongsToUser;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Calendar\Observers\CalendarObserver;
use Modules\Projects\Entities\Project;

class Calendar extends Model
{
    use SoftDeletes, BelongsToUser, Observable;

    protected static $observer = CalendarObserver::class;
    protected static $scope    = OwnerScope::class;

    protected $fillable = [
        'calendar_id',
        'event_name',
        'description',
        'start_date',
        'end_date',
        'project_id',
        'user_id',
        'color',
        'is_private',
        'location',
        'alert',
        'alerted_at',
        'alert_sent',
        'attendees',
        'eventable_type',
        'eventable_id',
        'url',
    ];

    protected $table = 'events';

    protected $casts = [
        'attendees' => 'array',
    ];
    protected $dates = ['start_date', 'end_date'];

    public function eventable()
    {
        return $this->morphTo();
    }

    public function AsProject()
    {
        return $this->belongsTo(Project::class);
    }

    public function calendar()
    {
        return $this->belongsTo(CalendarType::class);
    }

    public function scopeReminderAlerts($query)
    {
        return $query->whereDate('start_date', '>=', now())->whereNull('alerted_at');
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = dbDate($value);
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = dbDate($value);
    }

    public function setCalendarIdAttribute($value)
    {
        $this->attributes['calendar_id'] = $value > 0 ? $value : get_option('default_calendar');
    }
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id() ?? 1;
    }
}
