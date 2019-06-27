<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('mark_as_paid') </h4>
        </div>
        {!! Form::open(['route' => 'payments.api.pay', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('mark_as_paid_notice') </p>

            <strong>@langapp('balance')  : {{ formatCurrency($invoice->currency, $invoice->balance) }}

            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
            <input type="hidden" name="amount" value="{{ $invoice->due() }}">
            <input type="hidden" name="payment_date" value="{{ now()->toDateTimeString() }}">
            <input type="hidden" name="payment_method" value="2">
            <input type="hidden" name="gateway" value="offline">
            <input type="hidden" name="notes" value="Invoice marked as Paid by {{ Auth::user()->name }}">

        </div>
        <div class="modal-footer">
        {!! closeModalButton() !!}
        {!! renderAjaxButton('mark_as_paid') !!}

            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')