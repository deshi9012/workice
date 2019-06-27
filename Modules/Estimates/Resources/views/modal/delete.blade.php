<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')   {{$estimate->reference_no }} - {{  formatCurrency($estimate->currency, $estimate->amount) }}</h4>
        </div>
        {!! Form::open(['route' => ['estimates.api.delete', $estimate->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>
            
                @langapp('estimate') : <strong>#{{ $estimate->reference_no }}</strong><br>
                @langapp('due_date') : <strong>{{ dateString($estimate->due_date) }}</strong><br>
                @langapp('date') : <strong>{{ dateString($estimate->created_at) }}</strong><br>
                @langapp('amount') : <strong>{{ formatCurrency($estimate->currency, $estimate->amount) }}</strong><br>
                @langapp('status') : <strong>{{ $estimate->status }}</strong><br>

            
            <input type="hidden" name="id" value="{{ $estimate->id }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')
