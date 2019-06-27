<?php
namespace Modules\Milestones\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class MilestoneScope implements Scope
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
                        'AsProject.assignees.user',
                        function ($query) {
                            $query->where('user_id', Auth::id());
                        }
                    )
                        ->orWhereHas(
                            'AsProject',
                            function ($query) {
                                $query->where('client_id', Auth::user()->profile->company);
                            }
                        );
                }
            );
        }
    }
}
