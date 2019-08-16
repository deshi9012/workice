@extends('layouts.app')
@section('content')
	<section id="content" class="bg">
		<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-12 m-b-xs">
						<p class="h3">{{ $lead->name }}
							@can('leads_delete')
								<a href="{{ route('leads.delete', ['id' => $lead->id]) }}"
								   class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal" data-rel="tooltip"
								   title="@langapp('delete')  ">@icon('solid/trash-alt')</a>
							@endcan
							@can('reminders_create')
								<a class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right"
								   data-toggle="ajaxModal" data-rel="tooltip" data-placement="bottom"
								   href="{{  route('calendar.reminder', ['module' => 'leads', 'id' => $lead->id])  }}"
								   title="@langapp('set_reminder')  ">
									@icon('solid/clock')
								</a>
							@endcan
							@can('leads_update')
								<a href="{{ route('leads.edit', ['id' => $lead->id]) }}"
								   class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-rel="tooltip"
								   data-toggle="ajaxModal" title="@langapp('edit')  " data-placement="left">
									@icon('solid/pencil-alt') @langapp('edit') </a>
							@endcan
							@can('deals_create')
								@if($lead->stage_id != 54)
									<a href="#"
									   id="convert-lead-{{$lead->id}}"
									   class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right convert-lead"
									   data-placement="left">
										@icon('solid/check-circle') @langapp('convert')
									</a>
								@endif
							@endcan
							@can('leads_update')
								<a href="{{ route('leads.nextstage', ['id' => $lead->id]) }}"
								   class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-rel="tooltip"
								   data-toggle="ajaxModal" title="@langapp('move_stage')  " data-placement="left">
									@icon('solid/arrow-alt-circle-right') @langapp('next_stage') </a>
							@endcan

						</p>
					</div>
				</div>
			</header>
			<section class="scrollable wrapper">

				<div class="sub-tab m-b-10">
					<ul class="nav pro-nav-tabs nav-tabs-dashed">
						<li class="{{  ($tab == 'overview') ? 'active' : '' }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'overview'])  }}">@icon('solid/home')
								@langapp('overview') </a>
						</li>

						<li class="{{  ($tab == 'calls') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'calls'])  }}">@icon('solid/phone')
								@langapp('calls')
							</a>
						</li>

						<li class="{{  ($tab == 'conversations') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'conversations'])  }}">
								@icon('solid/envelope-open') @langapp('emails')
								{!! $lead->has_email ? '<i class="fas fa-bell text-danger"></i>' : '' !!}
							</a>
						</li>
						<li class="{{  ($tab == 'activity') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'activity'])  }}">
								@icon('solid/history') @langapp('activity')
								{!! $lead->has_activity ? '<i class="fas fa-bell text-danger"></i>' : '' !!}
							</a>
						</li>
						<li class="{{  ($tab == 'files') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'files'])  }}">
								@icon('solid/file-alt') @langapp('files') </a>
						</li>
						<li class="{{  ($tab == 'comments') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'comments'])  }}">
								@icon('solid/comments') @langapp('comments')
							</a>
						</li>
						<li class="{{  ($tab == 'calendar') ? 'active' : ''  }}">
							<a href="{{  route('leads.view', ['id' => $lead->id, 'tab' => 'calendar'])  }}">
								@icon('solid/calendar-alt') @langapp('calendar')
							</a>
						</li>
					</ul>
				</div>
				@include('leads::tab._'.$tab)

			</section>
		</section>
	</section>
	@push('pagescript')
		<script>

			$('.convert-lead').on('click', function () {
				var alertConfirm = confirm("Are you sure you want to change stage for this lead ?");


				if (alertConfirm) {
					var idVal = $(this).attr('id').split('-');

					var lead_id = idVal[2];

					axios.patch('{{ route('leads.update-stage') }}', {lead_id: lead_id, stage_id: 54})
						.then(function (response) {
							window.location.href = '/leads';
						});
				} else {
					$('#custom_stage_id').prop('selectedIndex', index);

					return false;
				}
			});


		</script>
		@include('stacks.js.markdown')
	@endpush
@endsection