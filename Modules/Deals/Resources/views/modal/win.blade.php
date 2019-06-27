<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ $deal->title }}</h4>
        </div>
        {!! Form::open(['route' => ['deals.api.won', $deal->id], 'class' => 'ajaxifyForm', 'data-toggle' => 'validator']) !!}
        <div class="modal-body">
            <input type="hidden" name="id" value="{{  $deal->id }}">

            <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-sign"></i> @langapp('deal_to_project_alert')
                  </div>

            <div class="padder m-b-md">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="convert_project" value="1">
                        <span class="label-text">@langapp('convert_deal_to_project', ['deal' => $deal->title])</span>
                    </label>
                </div>
                
            </div>
    </div>
    <div class="modal-footer">
        
        {!! closeModalButton() !!}
        {!!  renderAjaxButton('won', null, true) !!}
    
    </div>

{!! Form::close() !!}

</div>
</div>
@push('pagescript')
@include('stacks.js.markdown')
@include('partial.ajaxify')
@endpush

@stack('pagescript')