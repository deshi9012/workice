<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">@icon('solid/stopwatch') @langapp('timers') </h4>
		</div>
		
		<div class="modal-body">
			<table class="table m-b-none">
				<thead>
					
						<th>@langapp('user')</th>
						<th>@langapp('name')</th>
						<th></th>
						<th></th>
					
				</thead>
				<tbody>
					@foreach (runningTimers() as $timer)
					<?php $task = $timer['task_id'] > 0 ? true : false; ?>
					<tr>
						<td>
							<a class="thumb-sm avatar">
								<img src="{{ avatar($timer['user']['id']) }}" class="img-circle">
							</a>
						<span class="">{{ $timer['user']['name'] }}</span>
						</td>
						<td>
							<a href="{{ $timer['url'] }}">{{ $task ? Modules\Tasks\Entities\Task::select('id','name')->find($timer['task_id'])->name : $timer['timeable']['name'] }}</a>
						</td>
						<td class="timer" start="{{ $timer['start'] }}">
							<span class="text-danger text-dark"></span>
						</td>
						<td>
							@if (Auth::id() == $timer['user_id'])
								<a href="{{ route('clock.stop', ['id' => $task ? $timer['task_id'] : $timer['timeable']['id'], 'module' => $task ? 'tasks' : 'projects']) }}" class="btn btn-xs btn-danger" data-rel="tooltip" title="@langapp('stop')">@icon('solid/stop-circle')</a>
							@endif
						</td>
					</tr>
					@endforeach
					
					
				</tbody>
			</table>
			
		</div>
	</div>

	<script>
		update_timer();
		$('[data-rel="tooltip"]').tooltip(); 
	</script>
</div>