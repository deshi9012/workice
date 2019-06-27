@extends('layouts.public')
@section('content')
<section id="content" class="details-page bg">
	<div class="wrapper rating scrollable">
		<a href="{{ route('projects.index') }}" class="btn btn-info btn-sm">
		@icon('solid/home') Customer Portal</a>
		<h3>Customer Satisfaction for Project <strong>{{ $project->name }}</strong></h3>
		{!! Form::open(['route' => ['projects.rating', $token], 'class' => 'ajaxifyForm']) !!}
		How would you rate your experience?
		<div class="form-check text-muted m-t-xs">
			<label>
				<input type="radio" name="rating" checked value="1">
				<span class="label-text text-success">@icon('solid/thumbs-up') Good, I'm satisfied</span>
			</label>
		</div>
		<div class="form-check text-muted m-t-xs">
			<label>
				<input type="radio" name="rating" value="0">
				<span class="label-text text-danger">@icon('solid/thumbs-down')  Bad, I'm unsatisfied</span>
			</label>
		</div>
		
		<div class="form-group">
			<label>Add a comment about the quality of experience you received. </label>
			<textarea name="message" class="form-control markdownEditor"></textarea>
		</div>
		{!!  renderAjaxButton('send')  !!}
		{!! Form::close() !!}
	</div>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@endpush

@endsection