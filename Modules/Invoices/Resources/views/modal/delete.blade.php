<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete_invoice')  </h4>
        </div>

        {!! Form::open(['route' => ['invoices.api.delete', $invoice->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            <div class="m-sm">@langapp('reference_no') : <strong>{{ $invoice->name }} </strong></div>
            <div class="m-sm">@langapp('company_name') : <strong>{{ $invoice->company->name }} </strong></div>
            <div class="m-sm">@langapp('payable') : <strong>{{ $invoice->payable }} </strong></div>
            <div class="m-sm">@langapp('balance') : <strong>{{ formatCurrency($invoice->currency, $invoice->balance) }} </strong></div>

            <input type="hidden" name="id" value="{{  $invoice->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
           
        </div>
        {!! Form::close() !!}
        
    </div>

</div>
@include('partial.ajaxify')