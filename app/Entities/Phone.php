<?php

namespace App\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use BelongsToUser, SoftDeletes;
    
    protected $fillable = [
        'user_id','assignee','subject','duration','scheduled_date','type','result','description','cancelled_at',
        'reminder','notified_at','phoneable_type','phoneable_id'
    ];
    protected $table = 'calls';

    public function phoneable()
    {
        return $this->morphTo();
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'assignee', 'id');
    }
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id() ?? 1;
    }
}
