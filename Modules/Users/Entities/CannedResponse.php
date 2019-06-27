<?php

namespace Modules\Users\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CannedResponse extends Model
{
    use BelongsToUser, SoftDeletes;

    protected $fillable = ['subject', 'message', 'user_id'];

    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = \Auth::id();
    }
}
