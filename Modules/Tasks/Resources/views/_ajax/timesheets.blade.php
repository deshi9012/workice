@if ($task->isTeam() || isAdmin())
   <small class="text-uc text-xs text-muted">
    @langapp('timesheets')
    <a href="{{ route('timetracking.create', ['module' => 'projects', 'id' => $task->AsProject->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal" data-rel="tooltip" title="Add Time">@icon('solid/plus')</a>
</small>
<div class="line"></div>
@widget('Tasks.Timesheet', ['entries' => $task->timesheets])
@endif