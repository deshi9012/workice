<?php
namespace Modules\Contracts\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ContractScope implements Scope
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
            if (Auth::user()->can('contracts_view_all')) {
                return $builder;
            }
            $builder->where(
                function ($q) {
                    $q->orWhere('user_id', Auth::id())
                        ->orWhereHas(
                            'company',
                            function ($query) {
                                $query->where('client_id', Auth::user()->profile->company);
                            }
                        );
                }
            )->whereNotNull('sent_at');
        }
    }
}
