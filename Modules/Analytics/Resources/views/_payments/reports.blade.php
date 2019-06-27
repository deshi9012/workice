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
                        <header class="panel-heading">@langapp('payments_reports')</header>
                        <div class="row wrapper analytics">
                            <div class="col-sm-12 m-b-xs">
                                <form>
                                    <div class="inline v-middle col-md-4">
                                        <label>@langapp('date_range')</label>
                                        <input type="text" class="form-control" id="reportrange" name="range">
                                    </div>

                                    <div class="inline v-middle">
                                        <label>@langapp('project')</label>
                                        <select class="form-control input-s-sm" id="filter-project" name="project">
                                            <option value="-">-</option>
                                            @foreach (Modules\Payments\Entities\Payment::select('id', 'project_id')->whereNotNull('project_id')->with('project:id,name')->groupBy('project_id')->get() as $payment)
                                            <option value="{{ $payment->project_id }}">{{ optional($payment->project)->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="inline v-middle">
                                        <label>@langapp('client')</label>
                                        <select class="form-control input-s-sm" id="filter-client" name="client">
                                            <option value="-">-</option>
                                            @foreach (Modules\Payments\Entities\Payment::select('id', 'client_id')->with('company:id,name')->groupBy('client_id')->get() as $payment)
                                            <option value="{{ $payment->client_id }}">{{ optional($payment->company)->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="inline v-middle">
                                        <label>@langapp('invoice')</label>
                                        <select class="form-control input-s-sm" id="filter-invoice" name="invoice">
                                            <option value="-">-</option>
                                            @foreach (Modules\Payments\Entities\Payment::select('id', 'invoice_id')->with('AsInvoice:id,reference_no')->groupBy('invoice_id')->get() as $p)
                                            <option value="{{ $p->invoice_id }}">{{ optional($p->AsInvoice)->reference_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="inline v-middle">
                                        <label>@langapp('payment_method')</label>
                                        <select class="form-control input-s-sm" id="filter-payment-method" name="payment-method">
                                            <option value="-">-</option>
                                            @foreach (App\Entities\AcceptPayment::all() as $gateway)
                                            <option value="{{ $gateway->method_id }}">{{ $gateway->method_name }}</option>
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
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('analytics::_daterangepicker')
<script type="text/javascript">
$('#reportrange, #filter-client,  #filter-project, #filter-invoice, #filter-payment-method').change(function(event) {
loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.payments.filter') }}', {
    range: $('#reportrange').val(),
    client: $('#filter-client').val(),
    invoice: $('#filter-invoice').val(),
    project: $('#filter-project').val(),
    payment_method: $('#filter-payment-method').val(),
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