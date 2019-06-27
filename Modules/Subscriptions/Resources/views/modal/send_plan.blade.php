<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/paper-plane') @langapp('send') - {{ $plan->name }}</h4>
        </div>
        {!! Form::open(['route' => ['plans.api.send', $plan->id], 'class' => 'bs-example ajaxifyForm']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $plan->id }}">
        
            
            <p class="text-center m-lg">
                {!! (new Modules\Subscriptions\Emails\SendPlanMail($plan, null, null, false))->render() !!}
            </p>
            
        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('send')  !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@push('pagescript')
@include('partial.ajaxify')
@endpush
@stack('pagescript')