<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('stop_recurring')   <strong>#{{ $invoice->reference_no }}</strong></h4>
        </div>
        {!! Form::open(['route' => 'invoices.end_recur', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">

            <p>
                @langapp('recur_next_date')  : <strong>{{ dateTimeFormatted($invoice->recurring->next_invoice_date) }}</strong><br>
                @langapp('start_date')  : <strong>{{ dateTimeFormatted($invoice->recurring->recur_starts) }}</strong><br>
                @langapp('end_date')  : <strong>{{ dateTimeFormatted($invoice->recurring->recur_ends) }}</strong><br>
            </p>
            <p>Repeats every <strong>{{ $invoice->recurring->frequency }} Days</strong></p>

            <p>@langapp('stop_recur_warning') </p>
            


            <input type="hidden" name="id" value="{{ $invoice->id }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!!  renderAjaxButton('stop_recurring')  !!}
        </div>
        {!! Form::close() !!}
    </div>

</div>
@include('partial.ajaxify')