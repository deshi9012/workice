@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            @include('analytics::report_header')
                        </header>
                        <div class="panel-body">
                            <?php
                            $start_date = date('F d, Y', strtotime($range[0]));
                            $end_date = date('F d, Y', strtotime($range[1]));
                            ?>
                            <section class="panel panel-default">
                            <header class="panel-heading">@langapp('expenses_reports')</header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form>
                                        <div class="inline v-middle col-md-3">
                                            <label>@langapp('date_range')</label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label>@langapp('client')</label>
                                            <select class="form-control input-s-sm " id="filter-client" name="client">
                                                <option value="-">-</option>
                                                @foreach (Modules\Expenses\Entities\Expense::select('id', 'client_id')->with('company')->groupBy('client_id')->get() as $expense)
                                                <option value="{{ $expense->client_id }}">{{ optional($expense->company)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                        <label>@langapp('project')</label>
                                        <select class="form-control input-s-sm" id="filter-project" name="project">
                                            <option value="-">-</option>
                                            @foreach (Modules\Expenses\Entities\Expense::select('id', 'project_id')->whereNotNull('project_id')->with('AsProject:id,name')->groupBy('project_id')->get() as $expense)
                                            <option value="{{ $expense->project_id }}">{{ optional($expense->AsProject)->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('billable')</label>
                                            <select class="form-control input-s-sm" id="filter-billable" name="billable">
                                                <option value="-">-</option>
                                                <option value="1" selected>@langapp('yes') </option>
                                                <option value="0">@langapp('no') </option>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('billed')</label>
                                            <select class="form-control input-s-sm" id="filter-billed" name="billed">
                                                <option value="-">-</option>
                                                <option value="0">@langapp('no') </option>
                                                <option value="1">@langapp('yes') </option>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('category')</label>
                                            <select class="form-control input-s-sm" id="filter-category" name="category">
                                                <option value="-">-</option>
                                                @foreach (App\Entities\Category::select('id', 'name')->whereModule('expenses')->get() as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }} </option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                            
                            <div id="ajaxData"></div>
                            
                            
                            
                        </section>
                    </div>
                </section>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('analytics::_daterangepicker')
    <script type="text/javascript">
    $('#reportrange, #filter-client, #filter-project, #filter-billed, #filter-billable, #filter-category').change(function(event) {
        loadData(event);
    }).change();

    function loadData(val) {
            axios.post('{{ route('reports.expenses.filter') }}', {
                range: $('#reportrange').val(),
                client: $('#filter-client').val(),
                project: $('#filter-project').val(),
                billable: $('#filter-billable').val(),
                invoiced: $('#filter-billed').val(),
                category: $('#filter-category').val(),
            })
            .then(function (response) {
                    $('#ajaxData').html(response.data.html);
            })
            .catch(function (error) {
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
        });
}

    </script>
@endpush
@endsection