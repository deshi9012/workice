<li class="list-group-item" draggable="true" id="status-{{ $status->id }}">
	<span class="pull-right">
		<a href="{{ route('settings.statuses.edit', $status->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
			@icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
		</a>
		<a href="#" class="deleteStatus" data-status-id="{{ $status->id }}">
			@icon('solid/times', 'icon-muted fa-fw')
		</a>
	</span>
	<div class="clear">{{ $status->status }}</div>
</li>