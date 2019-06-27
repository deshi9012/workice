@if (($project->setting('show_project_gantt') && $project->isClient()) || isAdmin() || $project->isTeam())
<section class="scrollable">
	<section class="panel panel-default">
		<div class="m-xs">
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-sm btn-default">
					<input type="radio" name="options" value="Quarter Day">@langapp('quarter_day')
				</label>
				<label class="btn btn-sm btn-default">
					<input type="radio" name="options" value="Half Day">@langapp('half_day')
				</label>
				<label class="btn btn-sm btn-default active">
					<input type="radio" name="options" value="Day">@langapp('day')
				</label>
				<label class="btn btn-sm btn-default">
					<input type="radio" name="options" value="Week">@langapp('week')
				</label>
				<label class="btn btn-sm btn-default">
					<input type="radio" name="options" value="Month">@langapp('month')
				</label>
			</div>
		</div>
		
		<div class="project-gantt"></div>
	</section>
</section>
@if ($project->tasks->count() > 0)

@push('pagescript')
@include('stacks.js.gantt')
<script>
	var tasks = [
	@foreach ($project->tasks as $task)
		{
			start: '{{ $task->start_date }}',
			end: '{{ $task->due_date }}',
			name: '{{ $task->name }}',
			id: "{{ $task->id }}",
			project: "{{ $task->project_id }}",
			progress: {{ $task->progress }},
		},
	@endforeach
	];
	var gantt_chart = new Gantt(".project-gantt", tasks, {
		on_click: function (task) {
			
		},
on_date_change: function(task, start, end) {
	axios.put('/api/v1/tasks/'+task.id, {
		start_date: start,
		due_date: end,
		name:task.name,
		project_id:task.project
	})
	.then(function (response) {
		toastr.success( response.data.message , '@langapp('response_status') ');
	})
	.catch(function (error) {
		toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
	});
},
on_progress_change: function(task, progress) {
	axios.put('/api/v1/tasks/'+task.id, {
		progress: progress,
		start_date: task.start,
		due_date: task.end,
		name:task.name,
		project_id:task.project
	})
	.then(function (response) {
		toastr.success( response.data.message , '@langapp('response_status') ');
	})
	.catch(function (error) {
		toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
	});
},
on_view_change: function(mode) {
			
		}
	});
	gantt_chart.change_view_mode('Day');
	$(function() {
		$(".btn-group").on("change", "input[type='radio']", function() {
			var mode = $('input[name=options]:checked').val();
			gantt_chart.change_view_mode(mode);
		});
});
</script>
@endpush
@endif

@endif