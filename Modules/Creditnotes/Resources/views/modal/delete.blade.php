<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/trash-alt', 'fa-1x') @langapp('delete')   #{{ $creditnote->reference_no }}</h4>
        </div>
        {!! Form::open(['route' => ['credits.api.delete', $creditnote->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

    <p>
        @langapp('name')  : <strong>#{{ $creditnote->reference_no }}</strong><br>
        @langapp('client')  : <a href="{{ route('clients.view', ['id' => $creditnote->company->id]) }}"><strong>{{ $creditnote->company->name }}</strong></a><br>
        @langapp('amount')  : <strong>{{ formatCurrency($creditnote->currency, $creditnote->balance) }}</strong><br>
        @langapp('date')  : <strong>{{ dateTimeFormatted($creditnote->created_at) }}</strong><br>
    </p>

            <input type="hidden" name="id" value="{{  $creditnote->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')