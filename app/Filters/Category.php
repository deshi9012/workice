<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Contracts\FilterInterface;

class Category implements FilterInterface
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
        if ($value != '-') {
            return $builder->where('category', $value);
        }
        return $builder;
    }
}
