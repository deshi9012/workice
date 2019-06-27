<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/trash-alt', 'fa-1x') @langapp('delete') {{ $payment->code }}</h4>
        </div>
        {!! Form::open(['route' => ['payments.api.delete', $payment->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

    <p>
        @langapp('code')  : <strong>{{ $payment->code }}</strong><br>
        @langapp('client')  : <a href="{{ route('clients.view', ['id' => $payment->company->id]) }}"><strong>{{ $payment->company->name }}</strong></a><br>
        @langapp('amount')  : <strong>{{ formatCurrency($payment->currency, $payment->amount) }}</strong><br>
        @langapp('date')  : <strong>{{ dateTimeFormatted($payment->payment_date) }}</strong><br>
    </p>

            <input type="hidden" name="id" value="{{  $payment->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')