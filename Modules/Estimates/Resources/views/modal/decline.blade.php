<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') {{  langapp('decline')  }} {{$estimate->reference_no }} - {{  formatCurrency($estimate->currency, $estimate->amount) }}</h4>
        </div>
        {!! Form::open(['route' => ['estimates.api.cancel', $estimate->id], 'class' => 'bs-example ajaxifyForm']) !!}
        
        <div class="modal-body">
            <p>Any feedback on why the estimate is declined?</p>

            <input type="hidden" name="id" value="{{ $estimate->id }}">

            <div class="form-group">
                <label class="control-label">{{ langapp('reason') }} </label>
                
                    <textarea class="form-control markdownEditor" name="rejected_reason"></textarea>
            </div>

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            
            {!! renderAjaxButton('ok', 'fa fa-times-circle') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagescript')
    @include('stacks.js.markdown')
    @include('partial.ajaxify')
@endpush

@stack('pagescript')