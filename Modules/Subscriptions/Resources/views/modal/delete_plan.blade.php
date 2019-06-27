<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') - {{ $plan->name }}</h4>
        </div>
        {!! Form::open(['route' => ['plans.api.delete', $plan->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator', 'method' => 'DELETE']) !!}
        <input type="hidden" name="id" value="{{ $plan->id }}">
        <div class="modal-body">

            <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-exclation-triangle"></i>If you delete a plan that is already subscribed by your customer, they will not be able to cancel their subscription.
                  </div>

                  <div class="m-xs">@langapp('name') : <strong>{{ $plan->name }}</strong></div>
                  <div class="m-xs">@langapp('billing_date') : <strong>{{ dateTimeFormatted($plan->billing_date) }}</strong></div>
                  <div class="m-xs">@langapp('client') : <strong>{{ $plan->owner->name }}</strong></div>

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>


@push('pagescript')
@include('partial.ajaxify')
@endpush
@stack('pagescript')