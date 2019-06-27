<?php

namespace App\Traits;

use App\Entities\Phone;

trait Phoneable
{
    public function calls()
    {
        return $this->morphMany(Phone::class, 'phoneable')->orderBy('id', 'desc');
    }
}
