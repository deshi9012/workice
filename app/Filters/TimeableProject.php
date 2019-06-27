<?php
namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Modules\Projects\Entities\Project;

class TimeableProject implements FilterInterface
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
            return $builder->where('timeable_type', Project::class)->where('timeable_id', $value);
        }
        return $builder;
    }
}
