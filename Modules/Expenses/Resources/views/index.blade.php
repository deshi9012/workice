@extends('layouts.app')

@section('content')
<section id="content" class="bg">

            <section class="vbox">
                <header class="header panel-heading bg-white b-b b-light">
                    <div class="btn-group">
                        <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown">
                            @langapp('filter')  
                            <span class="caret">
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{  route('expenses.index', ['filter' => 'billed'])  }}">@langapp('billed')</a>
                            </li>
                            <li>
                                <a href="{{  route('expenses.index', ['filter' => 'billable'])  }}">@langapp('billable')</a>
                            </li>
                            <li>
                                <a href="{{  route('expenses.index', ['filter' => 'recurring'])  }}">@langapp('recurring')</a>
                            </li>
                            <li>
                                <a href="{{  route('expenses.index', ['filter' => 'archived'])  }}">@langapp('archived')</a>
                            </li>
                            <li>
                                <a href="{{  route('expenses.index')  }}">@langapp('all')</a>
                            </li>
                        </ul>
                    </div>
                    @admin
                    <a href="{{  route('expenses.category.show')  }}" class="btn btn-sm btn-{{  get_option('theme_color') }} pull-right" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('category')" data-placement="bottom">
                        @icon('solid/cogs')
                    </a>
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-placement="bottom" data-rel="tooltip" href="{{  route('expenses.export')  }}" title="@langapp('download')  ">
                        @icon('solid/cloud-download-alt') CSV
                    </a>
                    @endadmin
                    @can('expenses_create')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-placement="bottom" data-rel="tooltip" data-toggle="ajaxModal" href="{{  route('expenses.create')  }}" title="@langapp('create')  ">
                        @icon('solid/plus') @langapp('create')  
                    </a>
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-placement="bottom" data-rel="tooltip" data-toggle="ajaxModal" href="{{  route('expenses.import')  }}" title="@langapp('import')">
                        @icon('solid/cloud-upload-alt') @langapp('import')
                    </a>
                    @endcan
                    
                </header>
                <section class="scrollable wrapper">
                    <section class="panel panel-default">

                        @admin
                        @widget('Expenses.TotalsWidget')
                        @endadmin

                        <form id="frm-expense" method="POST">
                            <input type="hidden" name="module" value="expenses">

                        <div class="table-responsive">
                            <table class="table table-striped" id="expenses-table">
                                <thead>
                                    <tr>
                                        <th class="hide"></th>
                                        <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>
                                        <th class="">@langapp('code')</th>
                                        <th class="">@langapp('client')</th>
                                        <th class="">@langapp('project')</th>
                                        <th class="col-currency">@langapp('amount')</th>
                                        <th class="">@langapp('billed')</th>
                                        <th class="">@langapp('category')</th>
                                        <th class="col-date">@langapp('expense_date')</th>
                                    </tr>
                                </thead>
                            </table>

                        @can('expenses_update')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-bill">
                        <span class="">@icon('solid/check-circle') @langapp('billed')</span>
                        </button>
                        @endcan

                        @can('expenses_update')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-archive" data-rel="tooltip" title="@langapp('archive')">
                        @icon('solid/archive')
                        </button>
                        @endcan

                        @can('expenses_delete')
                        <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-delete" data-rel="tooltip" title="@langapp('delete')">
                        @icon('solid/trash-alt')
                        </button>
                        @endcan


                        </div>

                    </form>



                    </section>
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
    $('#expenses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('expenses.data') }}',
            data: {
                "filter": '{{ $filter }}',
            }
        },
        order: [[ 0, "desc" ]],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'chk', name: 'chk', orderable: false, searchable: false, sortable: false },
            { data: 'code', name: 'code' },
            { data: 'client_id', name: 'company.name' },
            { data: 'project_id', name: 'AsProject.name' },
            { data: 'cost', name: 'amount', orderable: false },
            { data: 'invoiced', name: 'invoiced' },
            { data: 'category', name: 'AsCategory.name' },
            { data: 'expense_date', name: 'expense_date' }
        ]
    });

    $("#frm-expense button").click(function(ev){
        ev.preventDefault();
    if($(this).attr("value")=="bulk-delete"){
            var form = $("#frm-expense").serialize();
            axios.post('{{ route('expenses.bulk.delete') }}', form)
                .then(function (response) {
                    toastr.warning(response.data.message, '@langapp('response_status') ');
                    window.location.href = response.data.redirect;
            })
            .catch(function (error) {
                showErrors(error);
            });
    }

    if($(this).attr("value")=="bulk-bill"){
        var form = $("#frm-expense").serialize();
        axios.post('{{ route('expenses.bulk.bill') }}', form)
        .then(function (response) {
        toastr.success(response.data.message, '@langapp('response_status') ');
            window.location.href = response.data.redirect;
        })
        .catch(function (error) {
            showErrors(error);
        });
    }

    if($(this).attr("value")=="bulk-archive"){
        var form = $("#frm-expense").serialize();
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
