<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('copy') - {{ $estimate->name }}</h4>
        </div>
        {!! Form::open(['route' => ['estimates.api.copy', $estimate->id], 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('estimate_duplicate_message', ['code' => $estimate->name, 'amount' => formatCurrency($estimate->currency, $estimate->amount)])</p>
            <p>
                @langapp('reference_no'): <strong>{{ $estimate->reference_no }}</strong><br>
                @langapp('client'): <strong>{{ $estimate->company->name }}</strong><br>
                @langapp('amount'): <strong>{{ formatCurrency($estimate->currency, $estimate->amount) }}</strong><br>
            </p>

            <input type="hidden" name="id" value="{{ $estimate->id }}">

        </div>
        <div class="modal-footer">
            
        {!! closeModalButton() !!}
        {!! renderAjaxButton('copy') !!}
        
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')
