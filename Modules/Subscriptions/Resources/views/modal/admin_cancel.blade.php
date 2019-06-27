<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-warning">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('cancel') - {{ $subscription->name }}</h4>
        </div>
        {!! Form::open(['route' => ['subscriptions.admin.deactivate'], 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}
        <input type="hidden" name="id" value="{{ $subscription->id }}">
        <div class="modal-body">
            <p>You are about to cancel subscription <strong>{{ $subscription->name }}</strong> for customer <a href="{{ route('clients.view', $subscription->owner->id) }}"><strong>{{ $subscription->owner->name }}</strong></a> created on <strong>{{ dateTimeFormatted($subscription->created_at) }}</strong></p>
            

            <div class="form-check text-muted">
                        <label>
                            <input type="hidden" name="cancel_immediately" value="0">
                            <input type="checkbox" name="cancel_immediately" value="1">
                            <div class="label-text text-danger">Cancel Immediately
                                <span class="help-block">If checked your subscription will be cancelled immediately. Leave unchecked to cancel subscription when fully expired</span>
                            </div>
                            
                        </label>
                    </div>

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