@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="vbox">
        
        <header class="header panel-heading bg-white b-b b-light">
            <div class="btn-group">
                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown"> @langapp('filter')  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('estimates.index', ['filter' => 'pending']) }}">@langapp('pending') </a>
                    </li>
                    <li>
                        <a href="{{ route('estimates.index', ['filter' => 'accepted']) }}">@langapp('accepted') </a>
                    </li>
                    <li>
                        <a href="{{ route('estimates.index', ['filter' => 'declined']) }}">@langapp('declined') </a>
                    </li>
                    <li>
                        <a href="{{ route('estimates.index', ['filter' => 'invoiced']) }}">@langapp('invoiced') </a>
                    </li>
                    <li>
                        <a href="{{ route('estimates.index', ['filter' => 'archived']) }}">@langapp('archived') </a>
                    </li>
                    
                    <li><a href="{{ route('estimates.index') }}">@langapp('all') </a></li>
                </ul>
            </div>
            
            @admin
            <div class="btn-group pull-right">
                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
                data-toggle="dropdown" data-rel="tooltip" title="@langapp('export')">@icon('solid/cloud-download-alt') CSV <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('estimates.export') }}">@langapp('estimates') </a>
                    </li>
                    <li>
                        <a href="{{ route('items.export', ['module' => 'estimates']) }}">@langapp('items') </a>
                    </li>
                    
                </ul>
            </div>
            @endadmin
            
            @can('estimates_create')
            <a href="{{  route('estimates.create')  }}"
                class="pull-right btn btn-sm btn-{{ get_option('theme_color')  }}">
            @icon('solid/plus') @langapp('create')  </a>
            @endcan
            
        </header>
        <section class="scrollable wrapper">
            <section class="panel panel-default">
                <form id="frm-estimate" method="POST">
                    <input type="hidden" name="module" value="estimates">
                    <div class="table-responsive">
                        <table class="table table-striped" id="estimates-table">
                            <thead>
                                <tr>
                                    <th class="hide"></th>
                                    <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>
                                    <th class="">@langapp('estimate')  </th>
                                    <th class="">@langapp('client')  </th>
                                    <th class="">@langapp('status')  </th>
                                    <th class="col-date">@langapp('due_date')  </th>
                                    <th class="col-currency">@langapp('amount')  </th>
                                    <th class="col-currency">@langapp('created_at')  </th>
                                </tr>
                            </thead>
                            
                        </table>
                        @can('estimates_send')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-send">
                        <span class="">@icon('solid/envelope-open') @langapp('send')</span>
                        </button>
                        @endcan

                        @can('estimates_update')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-archive" data-rel="tooltip" title="@langapp('archive')">
                        @icon('solid/archive')
                        </button>
                        @endcan

                        @can('estimates_delete')
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
    $('#estimates-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{!! route('estimates.data') !!}',
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
    { data: 'amount', name: 'amount' },
    { data: 'created_at', name: 'created_at' }
    ]
    });


    $("#frm-estimate button").click(function(ev){
    ev.preventDefault();
    if($(this).attr("value")=="bulk-delete"){
    var form = $("#frm-estimate").serialize();
    axios.post('{{ route('estimates.bulk.delete') }}', form)
    .then(function (response) {
    toastr.warning(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }
    if($(this).attr("value")=="bulk-send"){
    var form = $("#frm-estimate").serialize();
    axios.post('{{ route('estimates.bulk.send') }}', form)
    .then(function (response) {
    toastr.success(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }

    if($(this).attr("value")=="bulk-archive"){
    var form = $("#frm-estimate").serialize();
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
    <!-- end -->
    @endsection