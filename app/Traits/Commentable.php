<?php

namespace App\Traits;

use Modules\Comments\Entities\Comment;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where(
            function ($query) {
                $query->where('parent', 0)->orWhereNull('parent');
            }
        )->with('user:id,username,name')->orderBy('id', 'desc');
    }
}
