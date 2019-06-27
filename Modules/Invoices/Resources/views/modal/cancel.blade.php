<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('cancel') @langapp('invoice') #{{ $invoice->reference_no }}</h4>
        </div>
        {!! Form::open(['route' => ['invoices.api.cancel', $invoice->id], 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('cancel_invoice_message', ['code' => $invoice->name])</p>

            <input type="hidden" name="id" value="{{ $invoice->id  }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('cancelled') !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')
