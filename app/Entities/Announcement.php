<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['subject','message','announce_at', 'user_id','url'];
    protected $dates = ['announce_at'];

    public function setAnnounceAtAttribute($value)
    {
        $this->attributes['announce_at'] = dbDate($value);
    }
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }
}
