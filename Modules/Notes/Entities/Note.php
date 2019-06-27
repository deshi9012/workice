<?php

namespace Modules\Notes\Entities;

use App\Facades\EmojiOne;
use App\Traits\BelongsToUser;
use App\Traits\Noteable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Note extends Model
{
    use SoftDeletes, Noteable, BelongsToUser;
    
    protected $guarded = [];

    public function noteable()
    {
        return $this->morphTo();
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = Auth::check() ? Auth::id() : $value;
    }

    // public function getDescriptionAttribute($value)
    // {
    //     return EmojiOne::toImage($value);
    // }
}
