<section class="panel panel-default">

 @if (isAdmin() || $project->isTeam() || $project->setting('show_timesheets'))
        @include('timetracking::entries')
   @endif
</section>
