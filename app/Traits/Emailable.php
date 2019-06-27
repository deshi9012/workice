<?php

namespace App\Traits;

use Modules\Messages\Entities\Emailing;

trait Emailable
{
    public function emails()
    {
        return $this->morphMany(Emailing::class, 'emailable')->where('reply_id', 0)->orderBy('id', 'desc');
    }
}
