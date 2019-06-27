<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['tickets.api.delete', $ticket->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

            <p class="text-muted">
                @langapp('subject')  : <strong>{{ $ticket->subject }}</strong><br>
                @langapp('reporter')  : <strong>{{ $ticket->user->name }}</strong><br>
                @langapp('status')  : <strong class="text-uc">{{ $ticket->AsStatus->status }}</strong><br>
            </p>

            <input type="hidden" name="id" value="{{  $ticket->id  }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')