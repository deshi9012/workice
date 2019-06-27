<?php

namespace App\Traits;

use Modules\Calendar\Entities\Calendar;

trait Eventable
{
    public function schedules()
    {
        return $this->morphMany(Calendar::class, 'eventable');
    }
}
