<?php

namespace App\Traits;

use Modules\Activity\Entities\Activity;

trait Actionable
{
    public function activities()
    {
        return $this->morphMany(Activity::class, 'actionable')->with('user:id,username,name')->orderByDesc('id');
    }
}
