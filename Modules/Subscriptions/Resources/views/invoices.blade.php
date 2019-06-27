@extends('layouts.app')
@section('content')
<section class="bg" id="content">
    <section class="vbox">
        <header class="header panel-heading bg-white b-b b-light">
            @if(Auth::user()->profile->company > 0)
            <a class="btn btn-sm btn-{{ get_option('theme_color') }}" href="{{ route('subscriptions.index') }}" title="@langapp('subscriptions')">
                @icon('solid/shield-alt') @langapp('subscriptions')
            </a>
            @endif

                    
                    @if(isAdmin() || can('subscriptions_create'))
            <a class="btn btn-sm btn-{{ get_option('theme_color') }}" href="{{ route('plans.index') }}" title="@langapp('plans')">
                @icon('solid/unlock-alt') @langapp('plans')
            </a>
            <a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal" href="{{ route('plans.create') }}" title="@langapp('create')">
                @icon('solid/plus') @langapp('create')
            </a>
            @endif
        </header>
        <section class="scrollable wrapper">
            @if(Auth::user()->profile->company > 0 && !is_null(Auth::user()->profile->business->stripe_id))
            <section class="panel panel-default">
                <header class="panel-heading">
                    @langapp('invoices')
                </header>
                <div class="table-responsive">
                    <table class="table table-striped" id="subscriptions-invoice-table">
                        <thead>
                            <tr>
                                <th class="hide"></th>
                                <th>#ID</th>
                                <th>@langapp('amount')</th>
                                <th>@langapp('currency')</th>
                                <th>@langapp('subscription')</th>
                                <th>@langapp('due_date')</th>
                                <th>@langapp('created_at')</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->profile->business->subInvoices() as $invoice)
                                <tr>
                                    <td class="display-none">{{ $invoice->asStripeInvoice()->finalized_at }}</td>
                                    <td><a href="{{ $invoice->asStripeInvoice()->invoice_pdf }}">{{ $invoice->asStripeInvoice()->number }}</a></td>
                                    <td>{{ $invoice->total() }}</td>
                                    <td>{{ strtoupper($invoice->asStripeInvoice()->currency) }}</td>
                                    <td class="text-success">{{ $invoice->asStripeInvoice()->subscription }}</td>
                                    <td>{{ dateTimeFormatted(now()->createFromTimestamp($invoice->asStripeInvoice()->due_date)->toDateTimeString()) }}</td>
                                    <td>{{ dateTimeFormatted($invoice->date()->toFormattedDateString()) }}</td>
                                    <td>
                                        <a href="{{ $invoice->asStripeInvoice()->invoice_pdf }}">@icon('solid/receipt')</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </section>
            @else
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert" type="button">
                    ×
                </button>
                @icon('solid/exclamation-triangle') Your account is not associated to any company or you have no stripe invoices
            </div>
            @endif
        </section>
    </section>
    <a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
    </a>
</section>
@push('pagestyle')
    @include('stacks.css.datatables')
@endpush

@push('pagescript')
@include('stacks.js.datatables')
<script>
    $(function() {
            $('#subscriptions-invoice-table').DataTable({
                processing: true,
                order: [[ 0, "desc" ]],
            });
        });
</script>
@endpush
    @endsection
