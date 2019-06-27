<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait Searchable
{
    public function apply(array $filters)
    {
        return $this->applyDecoratorsFromRequest(collect($filters), $this->newQuery());
    }
    private function applyDecoratorsFromRequest(Collection $collection, Builder $query)
    {
        foreach ($collection->all() as $filterName => $value) {
            $decorator = $this->createFilterDecorator($filterName);
            if ($this->isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }
        return $query;
    }
    private function createFilterDecorator($name)
    {
        return 'App\Filters\\' . studly_case($name);
        // return __NAMESPACE__ . '\\Filters\\' . studly_case($name);
    }
    private function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
