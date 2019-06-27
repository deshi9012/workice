<?php

namespace App\Traits;

use Modules\Items\Entities\Item;

trait Itemable
{
    /**
     * Get model items
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function items()
    {
        return $this->morphMany(Item::class, 'itemable')->orderBy('order', 'asc');
    }
}
