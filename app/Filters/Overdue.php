<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Contracts\FilterInterface;

class Overdue implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  mixed                                 $value
     * @return \Illuminate\Database\Query\Builder $builder
     */

    public static function apply(Builder $builder, $value)
    {
        return $value == 1
        ? $builder->whereDate('due_date', '<', now()->toDateTimeString())->where('balance', '>', 0)
        : $builder->whereDate('due_date', '>', now()->toDateTimeString())->where('balance', '>', 0);
    }
}
