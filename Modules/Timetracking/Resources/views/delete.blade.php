<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['timers.api.delete', $entry->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            <input type="hidden" name="id" value="{{ $entry->id }}">
            <p>@langapp('time_spent') : <span class="text-semibold">{{ secToHours($entry->worked) }}</span></p>
            <p>@langapp('billable') : <span class="text-semibold">{{ $entry->billable ? langapp('yes') : langapp('no') }}</span></p>
            <p>@langapp('date') : <span class="text-semibold">{{ $entry->created_at->toDayDateTimeString() }}</span></p>
            <p>@langapp('user') : <span class="text-semibold text-danger">{{ $entry->user->name }}</span></p>

            <blockquote>
                <p>{{ $entry->notes }}</p>
            </blockquote>

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')