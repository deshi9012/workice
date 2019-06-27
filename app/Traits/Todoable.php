<?php

namespace App\Traits;

use Modules\Todos\Entities\Todo;

trait Todoable
{
    public function todos()
    {
        return $this->morphMany(Todo::class, 'todoable')->where(
            function ($query) {
                $query->where('parent', 0)->orWhereNull('parent');
            }
        )->orderBy('id', 'desc');
    }
}
