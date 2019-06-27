<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') <span class="small text-muted"> ({{ $lead->name }}) </span> </h4>
        </div>
        {!! Form::open(['route' => ['leads.api.delete', $lead->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'DELETE']) !!}
        <input type="hidden" name="id" value="{{ $lead->id }}">
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>
            <div class="m-sm">@langapp('name') : <strong>{{ $lead->name }} </strong></div>
            <div class="m-sm">@langapp('company_name') : <strong>{{ $lead->company }} </strong></div>
            <div class="m-sm">@langapp('stage') : <strong>{{ $lead->status->name }} </strong></div>
            <div class="m-sm">@langapp('lead_value') : <strong>{{ formatCurrency(get_option('default_currency'), $lead->lead_value) }} </strong></div>
            
            <div class="modal-footer">
                
                {!! closeModalButton() !!}
                {!!  renderAjaxButton('ok')  !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('partial.ajaxify')