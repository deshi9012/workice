<li class="list-group-item" draggable="true" id="calendar-{{ $calendar->id }}">
	<span class="pull-right">
		<a href="{{ route('settings.calendars.edit', $calendar->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
			@icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
		</a>
		<a href="#" class="deleteCalendar" data-calendar-id="{{ $calendar->id }}">
			@icon('solid/times', 'icon-muted fa-fw')
		</a>
	</span>
	<div class="clear">{{ $calendar->name }}</div>
</li>