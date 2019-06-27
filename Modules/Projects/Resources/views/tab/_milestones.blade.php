@if (($project->setting('show_milestones') && $project->isClient()) || isAdmin() || $project->isTeam())
<section class="scrollable">
	@if(!is_null($item))
	@php $data['milestone'] = Modules\Milestones\Entities\Milestone::findOrFail($item); @endphp
	@include('milestones::view', $data)
	@else
	@include('milestones::show_all')
	@endif
</section>
@endif