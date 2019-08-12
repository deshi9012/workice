@extends('layouts.app')
@section('content')
	<section id="content" class="bg">
		<section class="vbox">
			<header class="header bg-white b-b b-light">
				<div class="btn-group pull-right">
					<a href="{{ route('leads.index', ['view' => 'table']) }}" data-rel="tooltip" title="Table"
					   data-placement="bottom" class="btn btn-sm btn-default">
						@icon('solid/th')
					</a>
					<a href="{{ route('leads.index', ['view' => 'kanban']) }}" data-rel="tooltip" title="Kanban"
					   data-placement="bottom" class="btn btn-sm btn-default">
						@icon('solid/align-justify')
					</a>
					<a href="{{ route('leads.index', ['view' => 'heatmap']) }}" data-rel="tooltip" title="Heatmap"
					   data-placement="bottom" class="btn btn-sm btn-success">
						@icon('solid/chart-line')
					</a>
				</div>

				@if(!(Auth::user()->hasRole('sales agent') || Auth::user()->hasRole('sales team leader')))
					<div class="btn-group">
						<button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
								data-toggle="dropdown"> @langapp('filter')
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{  route('leads.index', ['filter' => 'converted'])  }}">
									@langapp('converted')
								</a>
							</li>
							<li>
								<a href="{{  route('leads.index', ['filter' => 'archived'])  }}">
									@langapp('archived')
								</a>
							</li>
							<li>
								<a href="{{  route('leads.index')  }}">
									@langapp('all')
								</a>
							</li>
						</ul>
					</div>
				@endif
				@if(!Auth::user()->hasRole('sales agent'))
					<a href="{{  route('leads.create')  }}" data-toggle="ajaxModal" data-rel="tooltip"
					   title="@langapp('create')" class="btn btn-sm btn-{{ get_option('theme_color') }}">
						@icon('solid/plus') @langapp('create')
					</a>
				@endif

				@admin
				<a href="{{ route('settings.stages.show', 'leads') }}" data-toggle="ajaxModal"
				   class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-rel="tooltip"
				   title="@langapp('stages')" data-placement="bottom">
					@icon('solid/cogs')
				</a>
				@endadmin

				{{--				@can('leads_create')--}}
				@admin
				<div class="btn-group">
					<button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
							data-toggle="dropdown" aria-expanded="false">@langapp('import') <span
								class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('leads.import', ['type' => 'leads']) }}" data-toggle="ajaxModal">@langapp('csv_file')</a>
						</li>
						<li><a href="{{ route('leads.import', ['type' => 'google']) }}">Google
								@langapp('contacts')</a></li>
					</ul>
				</div>


				<a href="{{  route('leads.export')  }}" title="@langapp('export')  "
				   class="btn btn-sm btn-{{ get_option('theme_color') }}">
					@icon('solid/file-csv') CSV
				</a>
				@endadmin
				{{--@endcan--}}


			</header>
			<section class="scrollable wrapper overflow-x-auto">


				<div class="row">
					@if ($displayType == 'table')
						@include('leads::table_view_converted')
					@endif
				</div>


			</section>
		</section>
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
	@push('pagescript')
		<script type="text/javascript">
			$(document).ready(function () {
				var kanbanCol = $('.scrumboard');
				draggableInit();
			});

			function draggableInit() {
				var sourceId;
				$('[draggable=true]').bind('dragstart', function (event) {
					sourceId = $(this).parent().attr('id');
					event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
				});
				$('.scrumboard').bind('dragover', function (event) {
					event.preventDefault();
				});
				$('.scrumboard').bind('drop', function (event) {
					var children = $(this).children();
					var targetId = children.attr('id');
					if (sourceId != targetId) {
						var elementId = event.originalEvent.dataTransfer.getData("text/plain");
						$('#processing-modal').modal('toggle');
						setTimeout(function () {
							var element = document.getElementById(elementId);
							id = element.getAttribute('id');
							axios.post('/api/v1/leads/' + id + '/movestage', {
								id: id,
								target: targetId
							})
								.then(function (response) {
									toastr.success(response.data.message, '@langapp('
									success
									') '
								)
									;
								})
								.catch(function (error) {
									var errors = error.response.data.errors;
									var errorsHtml = '';
									$.each(errors, function (key, value) {
										errorsHtml += '<li>' + value[0] + '</li>';
									});
									toastr.error(errorsHtml, '@langapp('
									response_status
									') '
								)
									;
								});
							children.prepend(element);
							$('#processing-modal').modal('toggle');
						}, 1000);
					}
					event.preventDefault();
				});
			}
		</script>
	@endpush
@endsection