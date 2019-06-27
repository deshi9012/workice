@extends('layouts.app')

@section('content')

<section id="content" class="bg">

            <section class="vbox">


                <header class="header panel-heading bg-white b-b b-light">
                            <div class="btn-group">

                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown"> @langapp('filter')   
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">

                
                <li><a href="{{  route('payments.index', ['filter' => 'today'])  }}">@langapp('today')</a></li>
                <li><a href="{{  route('payments.index', ['filter' => 'yesterday'])  }}">@langapp('yesterday')</a></li>
                <li><a href="{{  route('payments.index', ['filter' => 'week'])  }}">@langapp('this_week')</a></li>
                <li><a href="{{  route('payments.index', ['filter' => 'month'])  }}">@langapp('this_month')</a></li>
                <li><a href="{{  route('payments.index', ['filter' => 'archived'])  }}">@langapp('archived')</a></li>
                <li><a href="{{  route('payments.index')  }}">@langapp('all') </a></li>

                </ul>
                </div>

                            @admin
                            <a href="{{  route('payments.export')  }}" data-rel="tooltip" data-placement="bottom"
                                   title="@langapp('download')  "
                                   class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                                 @icon('solid/cloud-download-alt') CSV
                            </a>
                            @endadmin


                            
                </header>


                <section class="scrollable wrapper">
                    <section class="panel panel-default">

                        @admin
                        @widget('Payments.Totals')
                        @endadmin
                        
                        <form id="frm-payment" method="POST">
                            <input type="hidden" name="module" value="payments">

                        <div class="table-responsive">
                            <table class="table table-striped" id="payments-table">
                                <thead>
                                <tr>
                                    <th class="hide display-none"></th>
                                    <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>
                                    <th class="">@langapp('code')</th>
                                    <th class="">@langapp('client_name')  </th>
                                    <th class="col-date">@langapp('payment_date')  </th>
                                    <th class="col-date">@langapp('invoice_date')  </th>
                                    <th class="col-currency">@langapp('amount')  </th>
                                    <th class="">@langapp('payment_method')  </th>

                                </tr>
                                </thead>
                                
                            </table>

                        @can('payments_update')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-archive">
                        @icon('solid/archive') @langapp('archive')
                        </button>
                        @endcan

                        @can('payments_delete')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-delete" data-rel="tooltip" title="@langapp('delete')">
                        @icon('solid/trash-alt')
                        </button>
                        @endcan


                        </div>

                    </form>
                        
                    </section>
                </section>


    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>

@push('pagestyle')
    @include('stacks.css.datatables')
@endpush

@push('pagescript')
    @include('stacks.js.datatables')
<script>
$(function() {
    $('#payments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route('payments.data') !!}',
            data: {
                "filter": '{{ $filter }}',
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
            { data: 'id', name: 'id', searchable: false },
            { data: 'chk', name: 'chk', orderable: false, searchable: false, sortable: false },
            { data: 'code', name: 'code' },
            { data: 'client_id', name: 'company.name' },
            { data: 'payment_date', name: 'payment_date' },
            { data: 'invoice_date', name: 'AsInvoice.created_at', sortable: false },
            { data: 'amount', name: 'amount' },
            { data: 'payment_method', name: 'paymentMethod.method_name' }
        ]
    });

    $("#frm-payment button").click(function(ev){
    ev.preventDefault();

    if($(this).attr("value")=="bulk-delete"){
    var form = $("#frm-payment").serialize();
    axios.post('{{ route('payments.bulk.delete') }}', form)
    .then(function (response) {
        toastr.warning(response.data.message, '@langapp('response_status') ');
        window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }

    if($(this).attr("value")=="bulk-archive"){
        var form = $("#frm-payment").serialize();
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