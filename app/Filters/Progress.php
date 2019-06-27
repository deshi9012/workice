<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Contracts\FilterInterface;

class Progress implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  mixed                                 $value
     * @return \Illuminate\Database\Eloquent\Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        if ($value === 'backlog') {
            return $builder->backlog();
        }
        if ($value === 'ongoing') {
            return $builder->ongoing();
        }
        if ($value === 'completed') {
            return $builder->completed();
        }
        return $builder;
    }
}
