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
						@include('leads::table_view')
					@endif
					@if ($displayType == 'kanban')
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body collapse in">
									<div class="card-block">
										<div class="overflow-hidden">
											<div id="todo-lists-basic-demo"
												 class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
												@php
													$cards = App\Entities\Category::whereModule('leads')->orderBy('order', 'asc')->get();
												@endphp
												@foreach ($cards as $card)
													<div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
														<div id="lobilist-list-0"
															 class="lobilist lobilist-default">
															<div class="lobilist-header ui-sortable-handle">
																<div class="lobilist-title text-ellipsis text-uc text-muted">
																	<span class="arrow right"></span> {{ ucfirst($card->name) }}
																</div>
															</div>
															<div class="lobilist-body scrumboard slim-scroll"
																 data-disable-fade-out="true"
																 data-distance="0" data-size="3px" data-height="550"
																 data-color="#333333">
																<ul class="lobilist-items ui-sortable list"
																	id="{{ snake_case($card->name) }}">
																	@php $leadCounter = 0; @endphp
																	@foreach (Modules\Leads\Entities\Lead::whereNull('archived_at')->where('stage_id', $card->id)->with(['agent:id,username,name'])->orderBy('id', 'desc')->get() as $lead)
																		<li id="{{ $lead->id }}" draggable="true"
																			class="lobilist-item kanban-entry grab {{ !is_null($lead->unsubscribed_at) ? 'subscribe-bg' : '' }}">
																			<div class="lobilist-item-title text-ellipsis m-l-xs font14">
																				<a href="{{  route('leads.view', ['id' => $lead->id])  }}"
																				   class="">{{ $lead->name }}</a>
																				@if($lead->has_email)
																					@icon('regular/envelope',
																					'text-success')
																				@endif
																			</div>
																			<div class="lobilist-item-description text-muted">
																				<small class="pull-right xs">
																					@icon('regular/user')
																					{{  optional($lead->agent)->name  }}
																				</small>

																				<span class="text-bold">
                                                                    {{ $lead->computed_value }}
                                                                    
                                                                </span>
																			</div>
																			<small class="text-muted">
																				{{ !empty($lead->due_date) ? dateElapsed($lead->due_date) : '' }}
																			</small>
																			<div class="lobilist-item-duedate">
																				{{  dateFormatted($lead->due_date) }}
																			</div>
																			@if ($lead->sales_rep > 0)
																				<span class="thumb-xs avatar lobilist-check">
                                                                <img src="{{ $lead->agent->profile->photo }}"
																	 class="img-circle">
                                                            </span>
																			@endif
																			<div class="todo-actions">
																				@if ($lead->has_activity)
																					<div class="edit-todo todo-action">
																						<a href="{{ route('leads.view', ['id' => $lead->id, 'tab' => 'activity']) }}">
																							@icon('solid/tasks',
																							'text-warning')
																						</a>
																					</div>
																				@endif
																			</div>
																			<div class="drag-handler"></div>
																		</li>
																		@php $leadCounter++; @endphp
																	@endforeach
																</ul>
															</div>
															<div class="lobilist-footer">
																<strong>@metrics('leads_stage_'.$card->id)</strong>
																<strong class="pull-right">{{ $leadCounter }}
																	Lead(s)</strong>
															</div>
														</div>
													</div>
												@endforeach
												<div class="modal modal-static fade" id="processing-modal"
													 role="dialog" aria-hidden="true">
													<div class="modal-dialog processing-modal">
														<div class="modal-content">
															<div class="modal-body">
																<div class="text-center">
																	@icon('solid/sync-alt', 'fa-4x fa-spin')
																	<h4>Processing...</h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
					@if ($displayType == 'heatmap')
						@include('leads::heatmap_view')
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