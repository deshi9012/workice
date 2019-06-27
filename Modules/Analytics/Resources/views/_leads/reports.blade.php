@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
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
                        <header class="panel-heading">@langapp('leads_reports')</header>
                        <div class="row wrapper analytics">
                            <div class="col-sm-12 m-b-xs">
                                <form>
                                    <div class="inline v-middle col-md-4">
                                        <label>@langapp('date_range')</label>
                                        <input type="text" class="form-control" id="reportrange" name="range">
                                    </div>
                                    <div class="inline v-middle">
                                        <label>@langapp('stage')</label>
                                        <select class="form-control input-s-sm" id="filter-stage" name="stage">
                                            <option value="-">-</option>
                                            @foreach (App\Entities\Category::whereModule('leads')->get() as $stage)
                                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="inline v-middle">
                                        <label>@langapp('source')</label>
                                        <select class="form-control input-s-sm" name="source" id="filter-source">
                                            <option value="-">-</option>
                                            @foreach (App\Entities\Category::whereModule('source')->get() as $source)
                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="inline v-middle">
                                        <label>@langapp('sales_rep')</label>
                                        <select class="form-control input-s-sm" id="filter-sales-rep" name="sales_rep">
                                            <option value="-">-</option>
                                            @foreach (Modules\Leads\Entities\Lead::groupBy('sales_rep')->whereNotNull('sales_rep')->get() as $lead)
                                            <option value="{{ $lead->sales_rep }}">{{ optional($lead->agent)->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="inline v-middle">
                                        <label>@langapp('archived')</label>
                                        <select class="form-control input-s-sm" id="filter-archived" name="archived">
                                            <option value="-">-</option>
                                            <option value="0">@langapp('no')</option>
                                            <option value="1">@langapp('yes')</option>
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
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('analytics::_daterangepicker')
<script type="text/javascript">
$('#reportrange, #filter-stage, #filter-source, #filter-sales-rep, #filter-archived').change(function(event) {
loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.leads.filter') }}', {
range: $('#reportrange').val(),
stage: $('#filter-stage').val(),
source: $('#filter-source').val(),
sales_rep: $('#filter-sales-rep').val(),
archived: $('#filter-archived').val(),
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