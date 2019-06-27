<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/clock') @langapp('time_entry') - <span class="text-info">{{ $entry->user->name }}</span> </h4>
        </div>
        <div class="modal-body">

            @if($entry->is_started)
                <div class="pull-right">
                @icon('solid/clock', 'fa-spin fa-5x text-danger')
                </div>

                @endif

            <p>@langapp('name')  : <strong>{{ $entry->timeable->name }}</strong></p>
            @if($entry->task_id > 0)
            <p>@langapp('task')  : <a href="{{ route('projects.view',['id' => $entry->timeable->id,'tab' => 'tasks', 'item' => $entry->task_id]) }}">{{ optional($entry->task)->name }}</a></p>
            @endif
            <p>@langapp('date')  : <strong>{{ $entry->created_at->toDayDateTimeString() }}</strong></p>
            <p>@langapp('billable')  : <strong>{{ $entry->billable ? langapp('yes') : langapp('no') }}</strong></p>
            <p>@langapp('billed')  : <strong>{{ $entry->billed ? langapp('yes') : langapp('no') }}</strong></p>
            <p>@langapp('start')  : @icon('solid/clock', 'text-success') {{ $entry->start ? dateTimeFormatted( dateFromUnix($entry->start) ) : '' }} </p>
            <p>@langapp('stop')  : @icon('solid/clock', 'text-danger') {{ $entry->end ? dateTimeFormatted( dateFromUnix($entry->end) ) : '' }} </p>
            <p>@langapp('total_time')  : <strong>{{ secToHours($entry->worked) }}</strong> </p>

            <blockquote>@parsedown($entry->notes)</blockquote>




        </div>

    </div>    


</div>