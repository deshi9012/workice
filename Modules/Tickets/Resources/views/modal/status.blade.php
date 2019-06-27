<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/pencil-alt') @langapp('make_changes')</h4>
        </div>
        {!! Form::open(['route' => ['tickets.api.status', $ticket->id], 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            Change ticket <strong>{{ $ticket->subject }}</strong> to <strong>{{ ucfirst(App\Entities\Status::find($status)->status) }}</strong>
            <p class="m-t-sm text-muted">
                @langapp('subject')  : <strong>{{ $ticket->subject }}</strong><br>
                @langapp('reporter')  : <strong>{{ $ticket->user->name }}</strong><br>
                @langapp('status')  : <strong class="text-uc">{{ $ticket->AsStatus->status }}</strong><br>
            </p>
            <input type="hidden" name="status" value="{{ $status }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}

            {!! renderAjaxButton('ok') !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')