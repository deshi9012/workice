<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/copy') @langapp('copy') - {{ $expense->name }} ({{  formatCurrency($expense->currency, $expense->cost)  }})</h4>
        </div>
        {!! Form::open(['route' => ['expenses.api.copy', $expense->id], 'class' => 'ajaxifyForm']) !!}
        
        <div class="modal-body">
            <p>@langapp('expense_duplicate_message', ['code' => $expense->code, 'amount' => formatCurrency($expense->currency, $expense->cost) ])</p>

            <input type="hidden" name="id" value="{{  $expense->id  }}">

        </div>
        <div class="modal-footer">
        {!! closeModalButton() !!}

        {!! renderAjaxButton('copy') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagescript')
    @include('partial.ajaxify')
@endpush
@stack('pagescript')