<div class="table-responsive">
    <table id="table-tasks" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('name') </th>
                <th>@langapp('project') </th>
                <th>@langapp('milestone') </th>
                <th>@langapp('progress') </th>
                <th>@langapp('due_date') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            
            <tr>
                <td><a href="{{ route('tasks.view', ['id' => $task->id]) }}">{{ $task->name }}</a></td>
                <td><a href="{{ route('projects.view', ['id' => $task->project_id]) }}">{{ optional($task->AsProject)->name }}</a></td>
                <td class="">{{ optional($task->AsMilestone)->milestone_name }}</td>
                <td class="text-semibold">{{ $task->progress }}%</td>
                <td>{{ dateTimeFormatted($task->due_date) }}</td>
                
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>

@push('pagestyle')
@include('stacks.css.datatables')
@endpush
@push('pagescript')
@include('stacks.js.datatables')
<script>
$('#table-tasks').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')