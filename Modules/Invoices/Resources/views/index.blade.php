@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="vbox">
        <header class="header panel-heading bg-white b-b b-light">
            <div class="btn-group">
                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
                data-toggle="dropdown"> @langapp('filter')  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'paid']) }}">@langapp('paid') </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'unpaid']) }}">@langapp('not_paid') </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'partial']) }}">@langapp('partially_paid')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'archived']) }}">{{  langapp('archived') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'draft']) }}">@langapp('draft') </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'unsent']) }}">{{  langapp('unsent') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'sent']) }}">@langapp('sent') </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'viewed']) }}">{{  langapp('viewed') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'overdue']) }}">@langapp('overdue') </a>
                    </li>
                    <li>
                        <a href="{{ route('invoices.index', ['filter' => 'recurring']) }}">@langapp('recurring') </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('invoices.index') }}">@langapp('all')</a>
                    </li>
                </ul>
            </div>
            
            @admin
            <div class="btn-group pull-right">
                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
                data-toggle="dropdown" data-rel="tooltip" title="@langapp('export')">@icon('solid/cloud-download-alt') CSV <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('invoices.export') }}">@langapp('invoices') </a>
                    </li>
                    <li>
                        <a href="{{ route('items.export', ['module' => 'invoices']) }}">@langapp('items') </a>
                    </li>
                    
                </ul>
            </div>
            @endadmin
            
            
            @can('invoices_create')
            <a href="{{  route('invoices.create')  }}"
                class="pull-right btn btn-sm btn-{{ get_option('theme_color')  }}">
            @icon('solid/plus') @langapp('create')  </a>
            @endcan
            
            
            
            
            
        </header>
        <section class="scrollable wrapper">
            <section class="panel panel-default">

                @admin
                @widget('Invoices.TotalsWidget')
                @endadmin


                <form id="frm-invoice" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="module" value="invoices">
                
                <div class="table-responsive">
                    
                        <table class="table table-striped" id="invoices-table">
                            <thead>
                                <tr>
                                    <th class="hide display-none"></th>
                                    <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>
                                    <th class="">@langapp('invoice') </th>
                                    <th class="">@langapp('client_name') </th>
                                    <th class="">@langapp('status') </th>
                                    <th class="col-date">@langapp('due_date') </th>
                                    <th class="col-currency">@langapp('amount') </th>
                                    <th class="col-currency">@langapp('balance') </th>
                                </tr>
                            </thead>
                            
                        </table>
                        @can('invoices_send')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-send">
                        <span class="">@icon('solid/envelope-open') @langapp('send')</span>
                        </button>
                        @endcan
                        @can('invoices_pay')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-pay">
                        <span class="">@icon('solid/money-check-alt') @langapp('mark_as_paid')</span>
                        </button>
                        @endcan

                        @can('invoices_update')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-archive" data-rel="tooltip" title="@langapp('archive')">
                        @icon('solid/archive')
                        </button>
                        @endcan

                        @can('invoices_delete')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-delete" data-rel="tooltip" title="@langapp('delete')">
                        @icon('solid/trash-alt')
                        </button>
                        @endcan
                        
                    
                </div>
                </form>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
    @push('pagestyle')
    @include('stacks.css.datatables')
    @endpush
    @push('pagescript')
    @include('stacks.js.datatables')
    <script>
    $(function() {
    $('#invoices-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{!! route('invoices.data') !!}',
    data: {
    "filter": '{{ $filter }}',
    }
    },
    order: [[ 0, "desc" ]],
    columns: [
    { data: 'id', name: 'id' },
    { data: 'chk', name: 'chk', orderable: false, searchable: false, sortable: false },
    { data: 'reference_no', name: 'reference_no' },
    { data: 'client_id', name: 'company.name' },
    { data: 'status', name: 'status' },
    { data: 'due_date', name: 'due_date' },
    { data: 'payable', name: 'payable' },
    { data: 'balance', name: 'balance' }
    ]
    });
    $("#frm-invoice button").click(function(ev){
    ev.preventDefault();
    if($(this).attr("value")=="bulk-delete"){
    var form = $("#frm-invoice").serialize();
    axios.post('{{ route('invoices.bulk.delete') }}', form)
    .then(function (response) {
    toastr.warning(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }
    if($(this).attr("value")=="bulk-send"){
    var form = $("#frm-invoice").serialize();
    axios.post('{{ route('invoices.bulk.send') }}', form)
    .then(function (response) {
    toastr.success(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }
    if($(this).attr("value")=="bulk-pay"){
    var form = $("#frm-invoice").serialize();
    axios.post('{{ route('invoices.bulk.pay') }}', form)
    .then(function (response) {
    toastr.success(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }

    if($(this).attr("value")=="bulk-archive"){
    var form = $("#frm-invoice").serialize();
    axios.post('{{ route('archive.process') }}', form)
    .then(function (response) {
        toastr.warning(response.data.message, '@langapp('response_status') ');
        window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
}
    
    });

    function showErrors(error){
        var errors = error.response.data.errors;
        var errorsHtml= '';
        $.each( errors, function( key, value ) {
        errorsHtml += '<li>' + value[0] + '</li>';
        });
        toastr.error( errorsHtml , '@langapp('response_status') ');
    }

    });
    </script>
    @endpush
    @endsection