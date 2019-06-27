@extends('layouts.app')
@section('content')
<section id="content">
	<section class="hbox stretch">
		<aside>
			<section class="vbox">
				<section class="scrollable wrapper bg">
					<section class="panel panel-default">
						<header class="panel-heading">
							@include('analytics::report_header')
						</header>
						<div class="panel-body">
							<section class="panel panel-default">
							<header class="panel-heading">Help Docs</header>
							
							
							<div class="table-responsive">
								<table id="table-kb" class="table table-striped">
									<thead>
										<tr>
											<th>@langapp('user')</th>
											<th>@langapp('subject')</th>
											<th>@langapp('views')</th>
											<th>@langapp('ratings')</th>
										</tr>
									</thead>
									<tbody>
										@foreach (App\Entities\Feedback::where('reviewable_type', Modules\Knowledgebase\Entities\Knowledgebase::class)->with('user:id,username,name')->get() as $rating)
										<tr>
											<td>
												<span class="thumb-xs avatar">
													<img src="{{ $rating->user->profile->photo }}" class="img-circle">
												</span>
												<a href="#" class="">{{ $rating->user->name }}</a>
											</td>
											<td>{{ $rating->reviewable->subject }}</td>
											<td>{{ $rating->reviewable->views }}</td>
											<td>{{ percent($rating->reviewable->rating) }}%</td>
											
										</tr>
										
										@endforeach
									</tbody>
								</table>
							</div>
							
							
						</section>
					</div>
				</section>
			</section>
		</section>
	</aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.datatables')
@endpush
@push('pagescript')
@include('stacks.js.datatables')
<script>
$('#table-kb').DataTable({
	processing: true,
	order: [[ 0, "desc" ]],
	pageLength: 25
});
</script>
@endpush
@endsection