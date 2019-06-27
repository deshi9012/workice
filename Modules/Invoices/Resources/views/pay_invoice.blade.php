@extends('layouts.app')
@section('content')




<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix hidden-print">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                            <a href="{{ route('invoices.view', ['id' => $invoice->id])  }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-rel="tooltip" title="Back to Invoice" data-placement="bottom" >
                                @icon('solid/file-invoice-dollar') @langapp('invoice')
                            </a>
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper bg">
                <div class="col-md-6">
                    <header class="panel-heading">@langapp('payments')  </header>
                    
                        <ul class="list-feed media-list">
                            @foreach ($invoice->payments as $key => $payment)
                            <li class="media">
                                <div class="media-body">
                                    <a href="#">{{ $payment->company->name }}</a> paid {{ formatCurrency($payment->currency, $payment->amount) }} on {{ dateTimeString($payment->created_date) }} via {{ $payment->paymentMethod->method_name }} <br>
                                    <strong>Invoice Number: <a href="#">{{ $payment->AsInvoice->reference_no }}</a></strong>
                                </div>
                                
                            </li>
                            @endforeach
                            @if (count($invoice->payments) == 0)
                            <li class="media">
                                <div class="media-body">
                                    No Payments received
                                </div>
                            </li>
                            @endif
                            
                        </ul>
                        

            </div>
            <div class="col-md-6">
                <section class="panel panel-default">
                <header class="panel-heading">@langapp('pay_invoice') <span class="text-danger pull-right">@langapp('balance') - {{ formatCurrency($invoice->currency, $invoice->due()) }}</span></header>
                <div class="panel-body">
                    {!! Form::open(['route' => 'payments.api.pay', 'class' => 'ajaxifyForm', 'data-toggle' => 'validator', 'files' => true]) !!}
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id  }}">
                    <input type="hidden" name="gateway" value="offline">
                    <input type="hidden" name="send_email" value="0">
                    <div class="form-group">
                        <label class="control-label">@langapp('amount') ({{ $invoice->currency }}) <span data-rel="tooltip" title="Enter in format e.g 1800.99">@icon('solid/question-circle')</span> @required</label>
                        <input type="text" class="form-control money"
                        value="{{ formatDecimal($invoice->due())  }}" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">@langapp('payment_date')</label>
                        <div class="input-group">
                            <input class="datepicker-input form-control" size="16" type="text"
                            value="{{ datePickerFormat(now()) }}"
                            name="payment_date"
                            data-date-format="{{ get_option('date_picker_format') }}"
                            required>
                            <label class="input-group-addon btn" for="date">
                                @icon('solid/calendar-alt', 'text-muted')
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">@langapp('payment_method') @required</label>
                        
                        <select name="payment_method" class="form-control">
                            @foreach (App\Entities\AcceptPayment::all() as $key => $m)
                            <option value="{{ $m->method_id }}">{{ $m->method_name  }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="attach_slip" id="attach_slip">
                            <span class="label-text">@langapp('receipt') </span>
                        </label>
                        
                        
                    </div>
                    
                    
                    
                    <div id="attach_field display-none">
                        <div class="form-group">
                            <label class="control-label">@langapp('attach_file')</label>
                            <input type="file" name="uploads[]" multiple="">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="send_email" value="1" checked>
                            <span class="label-text">@langapp('send_email') </span>
                        </label>
                        
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label">@langapp('notes')  </label>
                        
                        <textarea name="notes" class="form-control ta"></textarea>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('invoices.view', ['id' => $invoice->id])  }}" class="btn btn-default btn-rounded"
                        data-dismiss="modal">@icon('solid/times') @langapp('cancel')  </a>
                        {!! renderAjaxButton() !!}
                        
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </section>
</section>
</aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.datepicker')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')
<script type="text/javascript">
    $("#attach_slip").click(function () {
    if ($("#attach_slip").is(":checked")) {
        $("#attach_field").show("fast");
    } else {
        $("#attach_field").hide("fast");
        }
    });
</script>
@endpush
@endsection