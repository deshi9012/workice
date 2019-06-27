<?php
namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Expired implements FilterInterface
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
        ? $builder->whereDate('expiry_date', '<', now())
        : $builder->whereDate('expiry_date', '>', now());
    }
}
