<?php

namespace App\Traits;

use App\Entities\Recurring;

trait Recurrable
{
    public function recurring()
    {
        return $this->morphOne(Recurring::class, 'recurrable')->orderByDesc('id');
    }
}
