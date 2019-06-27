<div class="panel-group m-b" id="accordion2">
  @foreach ($vaults as $vault)
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{ $vault->id }}" aria-expanded="false">
       @icon('solid/lock', 'text-success')  {{ $vault->key }}
      </a>
    </div>
    <div id="collapse{{ $vault->id }}" class="panel-collapse collapse no-height" aria-expanded="false">
      <div class="panel-body text-sm">
        @parsedown($vault->key_value)

        @if($vault->user_id == Auth::id())
        <a href="{{ route('extras.vaults.delete', ['id' => $vault->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/trash-alt')</a>
        <a href="{{ route('extras.vaults.edit', ['id' => $vault->id]) }}" class="btn btn-xs btn-default" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
  
  
</div>