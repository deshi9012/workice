@extends('layouts.app')
@section('content')
<section id="content">
	<section class="hbox stretch">
		<aside>
			<section class="vbox">
				<section class="scrollable wrapper">
					<section class="panel panel-default">
						<header class="panel-heading">
							@include('analytics::report_header')
						</header>
						<div class="panel-body">
							
							
							@widget('Tickets\BusyChart')
							
						</div>
					</section>
				</section>
			</section>
		</aside>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection