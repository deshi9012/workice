<?php

namespace App\Traits;

use App\Entities\Reminder;

trait Remindable
{
    public function reminders()
    {
        return $this->morphMany(Reminder::class, 'remindable');
    }
}
