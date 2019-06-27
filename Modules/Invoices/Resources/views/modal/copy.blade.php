<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/copy') @langapp('copy') - {{ $invoice->name }} ({{  formatCurrency($invoice->currency, $invoice->due())  }})</h4>
        </div>
        {!! Form::open(['route' => ['invoices.api.copy', $invoice->id], 'class' => 'ajaxifyForm']) !!}
        
        <div class="modal-body">
            <p>@langapp('invoice_duplicate_message', ['code' => $invoice->reference_no, 'balance' => formatCurrency($invoice->currency, $invoice->due()) ])</p>

            <input type="hidden" name="id" value="{{ $invoice->id }}">

        </div>
        <div class="modal-footer">
        {!! closeModalButton() !!}

        {!! renderAjaxButton('copy', 'fas fa-copy') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagescript')
    @include('partial.ajaxify')
@endpush
@stack('pagescript')