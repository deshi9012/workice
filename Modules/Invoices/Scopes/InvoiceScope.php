<?php
namespace Modules\Invoices\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class InvoiceScope implements Scope
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
            if (Auth::user()->can('invoices_view_all')) {
                return $builder;
            } else {
                $builder->where('client_id', Auth::user()->profile->company)->where('is_visible', 1);
            }
        }
    }
}
