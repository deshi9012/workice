<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/copy') @langapp('copy') - {{ $contract->contract_title }}</h4>
        </div>
        {!! Form::open(['route' => ['contracts.api.copy', $contract->id], 'class' => 'ajaxifyForm']) !!}
        
        <div class="modal-body">
            <p>@langapp('contract_duplicate_message', ['title' => $contract->contract_title, 'client' => $contract->company->name ])</p>

            <input type="hidden" name="id" value="{{ $contract->id }}">

        </div>
        <div class="modal-footer">
        {!! closeModalButton() !!}

        {!! renderAjaxButton('copy', 'fas fa-copy') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagescript')
    @include('partial.ajaxify')
@endpush
@stack('pagescript')