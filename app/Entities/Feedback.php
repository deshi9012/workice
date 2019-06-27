<?php

namespace App\Entities;

use App\Traits\BelongsToUser;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use BelongsToUser, Searchable;

    protected $guarded = [];

    public function reviewable()
    {
        return $this->morphTo();
    }
}
