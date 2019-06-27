<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('regular/clock') @langapp('reminder') - {{ $contract->contract_title }}</h4>
        </div>

        
        {!! Form::open(['route' => ['contracts.api.remind', $contract->id], 'class' => 'ajaxifyForm']) !!}
        
        
        <div class="modal-body">
            <p class="">@langapp('send_contract_message', ['email' => $contract->company->email])</p>

            <input type="hidden" name="id" value="{{ $contract->id }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

        </div>

        <div class="modal-footer">
        {!! closeModalButton() !!}

        {!! renderAjaxButton('send') !!}
            
        </div>
        
        {!! Form::close() !!}
        
    </div>
</div>
@include('partial.ajaxify')