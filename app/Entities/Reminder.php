<?php

namespace App\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class Reminder extends Model
{
    use BelongsToUser;

    protected $guarded = [];

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function remindable()
    {
        return $this->morphTo();
    }

    public function setReminderDateAttribute($value)
    {
        $this->attributes['reminder_date'] = dbDate($value);
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }
}
