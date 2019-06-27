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
                            <header class="panel-heading">@langapp('invoices_reports')</header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form>
                                        <div class="inline v-middle col-md-4">
                                            <label>@langapp('date_range')</label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('client')</label>
                                            <select class="form-control input-s-sm" name="client" id="filter-client">
                                                <option value="-">-</option>
                                                @foreach (Modules\Invoices\Entities\Invoice::select('id', 'client_id')->groupBy('client_id')->get() as $invoice)
                                                <option value="{{ $invoice->client_id }}">{{ optional($invoice->company)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('recurring')</label>
                                            <select class="form-control input-s-sm" name="recurring" id="filter-recurring">
                                                <option value="-">-</option>
                                                <option value="0">@langapp('no') </option>
                                                <option value="1">@langapp('yes') </option>
                                            </select>
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label>@langapp('status')</label>
                                            <select class="form-control input-s-sm" name="status" id="filter-status">
                                                <option value="-">-</option>
                                                <option value="not_paid" selected>@langapp('not_paid') </option>
                                                <option value="partially_paid">@langapp('partially_paid')</option>
                                                <option value="fully_paid">@langapp('paid') </option>
                                                <option value="cancelled">@langapp('cancelled') </option>
                                                <option value="overdue">@langapp('overdue') </option>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('sent')</label>
                                            <select class="form-control input-s-sm" name="sent" id="filter-sent">
                                                <option value="-">-</option>
                                                <option value="0">@langapp('no') </option>
                                                <option value="1">@langapp('yes') </option>
                                                
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
    $('#reportrange, #filter-client, #filter-recurring, #filter-status, #filter-sent').change(function(event) {
        loadData(event);
    }).change();

    function loadData(val) {
            axios.post('{{ route('reports.invoices.filter') }}', {
                range: $('#reportrange').val(),
                client: $('#filter-client').val(),
                recurring: $('#filter-recurring').val(),
                status: $('#filter-status').val(),
                sent: $('#filter-sent').val(),
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