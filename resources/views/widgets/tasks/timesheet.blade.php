<div class="panel-group m-b" id="accordion2">
  @foreach ($entries as $entry)
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse-entry-{{ $entry->id }}" aria-expanded="false">
       @if($entry->billed)
        <span data-rel="tooltip" title="Billed" data-placement="right">@icon('solid/check-circle', 'text-success')</span>
       @endif
       @if($entry->is_started)
        <span data-rel="tooltip" title="Timer Running" data-placement="right">@icon('solid/clock', 'fa-spin text-danger')</span>
       @endif
       <span class="text-bold">{{ secToHours($entry->worked) }}</span> - <span class="text-muted">{{ $entry->billable ? langapp('billable') : langapp('unbillable') }}</span> <span class="text-muted pull-right">{{ $entry->created_at->toRfc822String() }}</span>
      </a>
    </div>
    <div id="collapse-entry-{{ $entry->id }}" class="panel-collapse collapse" aria-expanded="false">
      <div class="panel-body text-sm">
        @parsedown($entry->notes)

        <a href="{{ route('timetracking.delete', ['id' => $entry->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/trash-alt')</a>
        <a href="{{ route('timetracking.edit', ['id' => $entry->id]) }}" class="btn btn-xs btn-default" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
      </div>
    </div>
  </div>
  @endforeach
  
  
</div>