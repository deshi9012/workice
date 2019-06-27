<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('balance') {{ formatCurrency($invoice->currency, $invoice->due()) }} (#{{ $invoice->reference_no }})</h4>
        </div>
        <div class="modal-body">

            @include('payments::'.strtolower($channel).'.form')

        </div>


    </div>
</div>
