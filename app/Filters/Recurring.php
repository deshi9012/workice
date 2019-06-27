<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Contracts\FilterInterface;

class Recurring implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  Builder $builder
     * @param  mixed   $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $value == '1' ? $builder->where('is_recurring', 1) : $builder->where('is_recurring', 0);
    }
}
