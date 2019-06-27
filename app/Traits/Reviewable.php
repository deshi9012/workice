<?php

namespace App\Traits;

use App\Entities\Feedback;

trait Reviewable
{
    public function reviews()
    {
        return $this->morphMany(Feedback::class, 'reviewable');
    }
}
