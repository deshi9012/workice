@if(($project->setting('show_project_calendar') && $project->isClient()) || isAdmin() || $project->isTeam())
<section class="scrollable">
    @if (can('projects_update') || $project->isTeam() || $project->setting('show_project_calendar'))
        <div class="calendar" id="cal"></div>
    @endif
</section>


@push('pagestyle')
    @include('stacks.css.fullcalendar')
@endpush


@push('pagescript')
@include('stacks.js.fullcalendar')
@include('calendar::project')
@endpush

@endif