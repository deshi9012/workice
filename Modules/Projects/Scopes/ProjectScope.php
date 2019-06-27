<?php
namespace Modules\Projects\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class ProjectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check() && !isAdmin()) {
            if (Auth::user()->can('projects_view_all')) {
                return $builder;
            }

            $builder->where(
                function ($q) {
                    $q->orWhereHas(
                        'assignees.user',
                        function ($query) {
                            $query->where('user_id', Auth::id());
                        }
                    )
                    ->orWhere('manager', Auth::id())
                    ->orWhere('client_id', Auth::user()->profile->company);
                }
            );
        }
    }
}
