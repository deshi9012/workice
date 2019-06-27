<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete_deal')  </h4>
        </div>

        {!! Form::open(['route' => ['deals.api.delete', $deal->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}

        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

            <div class="m-sm">@langapp('deal') : <strong>{{ $deal->title }} </strong></div>
            <div class="m-sm">@langapp('company_name') : <strong>{{ $deal->company->name }} </strong></div>
            <div class="m-sm">@langapp('pipeline') : <strong>{{ $deal->pipe->name }} </strong></div>
            <div class="m-sm">@langapp('source') : <strong>{{ $deal->AsSource->name }} </strong></div>

            <input type="hidden" name="id" value="{{  $deal->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')
