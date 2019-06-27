<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('refunded')   - {{  $payment->currency  }} {{  $payment->amount  }}</h4>
        </div>
        {!! Form::open(['route' => ['payments.api.refund', $payment->id], 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('refund_payment_warning')  </p>

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