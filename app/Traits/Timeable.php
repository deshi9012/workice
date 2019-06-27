<?php

namespace App\Traits;

use Modules\Timetracking\Entities\TimeEntry;

trait Timeable
{
    public function timesheets()
    {
        return $this->morphMany(TimeEntry::class, 'timeable')->orderBy('id', 'desc');
    }
}
