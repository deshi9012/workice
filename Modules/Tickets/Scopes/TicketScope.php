<?php
namespace Modules\Tickets\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TicketScope implements Scope
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
                    $q->orWhereIn('department', array_pluck(Auth::user()->departments->toArray(), 'department_id'))
                        ->orWhere('user_id', Auth::id())
                        ->orWhereHas(
                            'user.profile.business',
                            function ($query) {
                                $query->where('company', Auth::user()->profile->company);
                            }
                        );
                }
            );
        }
    }
}
