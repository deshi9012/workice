<?php
namespace Modules\Payments\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PaymentScope implements Scope
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
            if (Auth::user()->can('payments_view_all')) {
                return $builder;
            }
            $builder->where(
                function ($q) {
                    $q->orWhere('client_id', Auth::user()->profile->company)
                        ->orWhereHas(
                            'project',
                            function ($query) {
                                $query->where('client_id', Auth::user()->profile->company);
                            }
                        );
                }
            );
        }
    }
}
