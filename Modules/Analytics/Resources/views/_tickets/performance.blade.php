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



@php
$start_date = date('F d, Y', strtotime($range[0]));
$end_date = date('F d, Y', strtotime($range[1]));
@endphp


								<section class="panel panel-default">
									<header class="panel-heading">Agents Performance</header>
									<div class="row wrapper">
										<div class="col-sm-10 m-b-xs">
											<form>

												<div class="inline v-middle col-md-6">

													<input type="text" class="form-control" id="reportrange" name="range">
												</div>

												



											</form>

										</div>


                                    </div>
                                    
                                    
									<div id="ajaxData"></div>
                                    

                                    


								</section>














						</div>

					</section>
				</section>


			</section>
		</aside>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@push('pagescript')
@include('analytics::_daterangepicker')
<script type="text/javascript">
$('#reportrange').change(function(event) {
	loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.agents.filter') }}', {
    range: $('#reportrange').val(),
})
.then(function (response) {
	$('#ajaxData').html(response.data.html);
})
.catch(function (error) {
    toastr.error( 'Failed loading data' , '@langapp('response_status') ');
});
}
</script>
@endpush

@endsection