<?php

namespace App\Traits;

use Modules\Users\Entities\User;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class)->with('profile:user_id,avatar,use_gravatar,hourly_rate,job_title,company,channels');
    }
}
