<?php

namespace Modules\Calendar\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Calendar\Observers\AppointmentObserver;
use Modules\Leads\Entities\Lead;
use Modules\Users\Entities\User;

class Appointment extends Model
{
    use SoftDeletes, BelongsToUser, Observable;

    protected $fillable = [
        'name',
        'venue',
        'attendee_id',
        'lead_id',
        'start_time',
        'finish_time',
        'comments',
        'alert',
        'reminded_at',
        'user_id',
        'status',
        'timezone',
        'token',
    ];

    protected static $observer = AppointmentObserver::class;
    protected static $scope    = null;

    protected $dates = ['start_time', 'finish_time'];

    public function attendee()
    {
        return $this->belongsTo(User::class, 'attendee_id');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    public function getStatusAttribute()
    {
        switch ($this->getOriginal('status')) {
            case 'R':
                return 'Reserved';
                break;
            case 'C':
                return 'Confirmed';
                break;
            case 'A':
                return 'Annulated';
                break;
            case 'S':
                return 'Served';
                break;
            default:
                return 'Unknown';
                break;
        }
    }

    public function scopeReminderAlerts($query)
    {
        return $query->whereDate('start_time', '>=', now())->whereNull('reminded_at');
    }
    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = dbDate($value);
    }

    public function setFinishTimeAttribute($value)
    {
        $this->attributes['finish_time'] = dbDate($value);
    }
}
