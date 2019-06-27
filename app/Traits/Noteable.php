<?php

namespace App\Traits;

use Modules\Notes\Entities\Note;

trait Noteable
{
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable')->where('user_id', \Auth::id())->with('user:id,username,name')->orderByDesc('id');
    }
}
