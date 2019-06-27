<?php
namespace Modules\Todos\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class TodoScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::check() && !isAdmin()) {
            $builder->where(
                function ($q) {
                    $q->orWhereHas(
                        'agent', function ($query) {
                            $query->where('assignee', Auth::id());
                        }
                    )
                    ->orWhere('user_id', \Auth::id());
                }
            );
        }
    }
}
