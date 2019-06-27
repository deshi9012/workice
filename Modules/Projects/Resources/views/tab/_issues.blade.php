@if(($project->setting('show_project_issues') && $project->isClient()) || isAdmin() || $project->isTeam())
<section class="scrollable">


    @if(!is_null($item))
        @php $data['issue'] = Modules\Issues\Entities\Issue::findOrFail($item); @endphp
        @include('issues::view', $data)

    @else

        @include('issues::show_all')

    @endif


@endif