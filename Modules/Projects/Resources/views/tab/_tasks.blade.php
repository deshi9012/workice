@if (($project->setting('show_project_tasks') && $project->isClient()) || can('projects_view_tasks') || $project->isTeam())
    
    @if(!is_null($item))
        @php 
        $task = Modules\Tasks\Entities\Task::findOrFail($item); 
        $data['isTeam'] = $task->isTeam();
        $data['task'] = $task;
        @endphp
        @include('tasks::view', $data)

    @else
        @php
            $data['filter'] = request('filter');
        @endphp
        @include('tasks::show_all', $data)

    @endif

   
@endif
