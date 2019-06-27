@extends('layouts.app')
@section('content')
	<section id="content">
		<section class="vbox">
			<section class="scrollable">
				<section class="hbox stretch">


					@if (isAdmin())
						@include('dashboard::_users.admin')

					@elseif(Auth::user()->hasRole('staff'))

						@include('dashboard::_users.staff')

					@else
						@include('dashboard::_users.clients')

					@endif
				</section>

			</section>

		</section>

		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
@endsection