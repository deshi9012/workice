<style>
	/* The Modal (background) */
	.modal-ask {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0, 0, 0); /* Fallback color */
		background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content-ask {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 30%;
	}

	/* The Close Button */
	.close-ask {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	button#yes, button#no{
		margin:5px;
		width: 60px;
	}
</style>
<div class="row">
	<div class="col-lg-4 b-r">
		<section class="panel panel-default">
			<header class="panel-heading">@langapp('overview')</header>
			<section class="panel-body">

				<div class="m-xs">
					<span class="text-muted">ID:</span>
					<span class="text-bold" id="lead-id">{{ $lead->id }}</span>
				</div>
				<div class="m-xs">
					<span class="text-muted">@langapp('created_at'):</span>
					<span class="text-bold">{{  dateFormatted($lead->created_at)  }}</span>
				</div>

				<div class="m-xs">
					<span class="text-muted">Desk:</span>
					<span class="text-bold text-danger">{{  ucfirst($lead->desk)  }}</span>
				</div>
				<div class="m-xs">
					<span class="text-muted">{{  langapp('stage')  }}:</</span>
					{{--<span class="text-bold text-danger">{{  ucfirst($lead->status->name)  }}</span>--}}
					<select id="custom_stage_id" name="stage_id">
						@foreach (App\Entities\Category::leads()->get() as $stage)
							<option class="text-bold text-danger" value="{{ $stage->id }}"
									{{ $stage->id == $lead->stage_id ? ' selected' : '' }}>{{ ucfirst($stage->name) }}</option>
						@endforeach
					</select>
				</div>

				<div class="m-xs">
					<span class="text-muted">@langapp('source'):</span>
					<span class="text-bold">{{  $lead->AsSource->name  }}</span>
				</div>

				<div class="m-xs">
					<span class="text-muted">{{ langapp('lead_age')  }}:</span>
					<span class="text-bold">{{ dateElapsed($lead->created_at)  }}</span>
				</div>

				<div class="m-xs">
					<span class="text-muted">{{ langapp('lead_value') }}:</span>
					<span class="text-bold">{{ $lead->computed_value }}</span>
				</div>

				<div class="m-xs">
					<span class="text-muted">@langapp('next_followup'):</span>
					<span class="text-bold">{{  dateFormatted($lead->next_followup)  }}</span>
				</div>

				<div class="m-xs m-b-sm">
					<span class="text-muted" data-rel="tooltip" title="GDPR Privacy">{{  langapp('data_processing')  }}
						:</span>
					<span class="text-bold text-danger">{{ is_null($lead->unsubscribed_at) ? '✔︎' : '✘' }}
						@if(!is_null($lead->unsubscribed_at))
							<a href="{{ route('leads.consent', ['lead' => $lead->id]) }}" class="btn btn-xs btn-success"
							   data-rel="tooltip" title="Send Consent">@icon('solid/user-lock')</a>
						@endif
					</span>
				</div>

				<div class="progress progress-xs progress-striped active">
					<div class="progress-bar progress-bar-success" data-toggle="tooltip"
						 data-original-title="{{ $lead->score }}%" style="width:{{ $lead->score }}%"></div>
				</div>

				@if ($lead->sales_rep > 0)

					<h4 class="font-thin">@langapp('sales_rep')</h4>



					<div class="line"></div>

					<span class="thumb-sm avatar lobilist-check">
					<img src="{{ $lead->agent->profile->photo  }}" class="img-circle">
				</span> <strong>{{ $lead->agent->name }}</strong>
				@endif


				<h4 class="font-thin">Lead Profile</h4>
				<div class="line"></div>

				@if(!empty($lead->name))
					<small class="text-uc text-xs text-muted">@langapp('name')</small>
					<p>{{ $lead->name }}</p>
				@endif

				@if(!empty($lead->email))
					<small class="text-uc text-xs text-muted">@langapp('email')</small>
					<p>{{ $lead->email }}</p>
				@endif
				@if(!empty($lead->mobile))
					<small class="text-uc text-xs text-muted">@langapp('mobile')</small>
					<p>{{ $lead->mobile }}</p>
				@endif

				@if(!empty($lead->phone))
					<small class="text-uc text-xs text-muted">@langapp('phone')</small>
					<p>{{ formatPhoneNumber($lead->phone) }}</p>
				@endif

				{{--@if(!empty($lead->company))--}}
				{{--<small class="text-uc text-xs text-muted">@langapp('company_name') </small>--}}
				{{--<p>{{ $lead->company }}</p>--}}
				{{--@endif--}}

				@if(!empty($lead->timezone))
					<small class="text-uc text-xs text-muted">@langapp('timezone')</small>
					<p>{{ $lead->timezone }}</p>
				@endif

				@if(!empty($lead->address1))
					<small class="text-uc text-xs text-muted">@langapp('address') 1</small>
					<p>{{ $lead->address1 }}</p>
				@endif

				@if(!empty($lead->address2))
					<small class="text-uc text-xs text-muted">@langapp('address') 2</small>
					<p>{{ $lead->address2 }}</p>
				@endif

				@if(!empty($lead->city))
					<small class="text-uc text-xs text-muted">@langapp('city')</small>
					<p>{{ $lead->city }}</p>
				@endif

				@if(!empty($lead->zip_code))
					<small class="text-uc text-xs text-muted">@langapp('zipcode')</small>
					<p>{{ $lead->zip_code }}</p>
				@endif

				@if(!empty($lead->state))
					<small class="text-uc text-xs text-muted">@langapp('state')</small>
					<p>{{ $lead->state }}</p>
				@endif

				@if(!empty($lead->country))
					<small class="text-uc text-xs text-muted">@langapp('country')</small>
					<p>{{ $lead->country }}</p>
				@endif


				<div class="m-xs">
					@if(!empty($lead->skype))

						<a href="skype:{{ $lead->skype }}?call" class="btn btn-rounded btn-info btn-icon shadowed">
							@icon('brands/skype')</a>

					@endif

					@if(!empty($lead->twitter))
						<a href="{{ $lead->twitter }}" target="_blank"
						   class="btn btn-rounded btn-twitter btn-icon shadowed">
							@icon('brands/twitter')
						</a>
					@endif

					@if(!empty($lead->facebook))
						<a href="{{ $lead->facebook }}" target="_blank"
						   class="btn btn-rounded btn-info btn-icon shadowed">
							@icon('brands/facebook')
						</a>
					@endif

					@if(!empty($lead->linkedin))
						<a href="{{ $lead->linkedin }}" target="_blank"
						   class="btn btn-rounded btn-primary btn-icon shadowed">
							@icon('brands/linkedin')
						</a>
					@endif

					@if(!empty($lead->website))
						<a href="{{ $lead->website }}" target="_blank"
						   class="btn btn-rounded btn-danger btn-icon shadowed">
							@icon('solid/link')
						</a>
					@endif

				</div>

				{{--<div class="map">--}}
				{{--<a href="{{ $lead->maplink }}" rel="nofollow" target="_blank">--}}
				{{--<img src="//maps.googleapis.com/maps/api/staticmap?center={{ $lead->map }}&amp;zoom=14&amp;scale=2&amp;size=600x340&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;key=AIzaSyAzrmdGlvKbFu9F7vPaY0Jg74q1WQo7B0w"--}}
				{{--alt="Google Map">--}}

				{{--</a>--}}
				{{--</div>--}}


				<div class="line"></div>
				<small class="text-uc text-xs text-muted">@langapp('tags')</small>
				<div class="m-xs">
					@php
						$data['tags'] = $lead->tags;
					@endphp
					@include('partial.tags', $data)
				</div>

				<div class="line"></div>
				<small class="text-uc text-xs text-muted">@langapp('message')</small>
				<div class="m-xs">
					@parsedown($lead->message)
				</div>

			</section>
		</section>
		<section class="panel panel-default">
			<header class="panel-heading">@langapp('extras')</header>
			<section class="panel-body">

				@foreach ($lead->custom as $key => $field)
					@if (App\Entities\CustomField::whereName($field->meta_key)->count() > 0)

						<small class="text-uc text-xs text-muted">{{  ucfirst(humanize($field->meta_key, '-'))  }}</small>
						<p>{{ isJson($field->meta_value) ? implode(', ', json_decode($field->meta_value)) : $field->meta_value }}
						</p>




					@endif
				@endforeach
			</section>
		</section>
		<section class="panel panel-default">
			<header class="panel-heading">@langapp('activities')</header>
			<div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0"
				 data-height="500px" data-size="3px">
				@widget('Activities\Feed', ['activities' => $lead->activities])
			</div>
		</section>
	</div>

	<div class="col-lg-8">

		@php
			$data = [
			'notes' => $lead->notes, 'noteable_type' => get_class($lead),
			'title' => $lead->name.' Note', 'noteable_id' => $lead->id
			];
		@endphp

		@widget('Notes\ShowNotes', $data)


	</div>
	<!-- The Modal -->
	<div id="myModal" class="modal-ask">

		<!-- Modal content -->
		<div class="modal-content-ask">
			<span class="close-ask">&times;</span>
			<div id="message-modal"></div>
		</div>

	</div>


</div>
@push('custom-pagescript')
	{{--<script type="text/javascript">--}}
	{{--$(document).ready(function () {--}}

	{{--$('#custom_stage_id').on('change', function () {--}}
	{{--var lead_id = $('#lead-id').text();--}}
	{{--var data = {--}}
	{{--'stage_id': $(this).val()--}}
	{{--};--}}

	{{--$.ajax({--}}
	{{--type: "GET",--}}
	{{--url: 'api/'.lead_id,--}}
	{{--data: data,--}}

	{{--success: function (response) {--}}
	{{--console.log(response);--}}
	{{--}--}}
	{{--});--}}
	{{--});--}}
	{{--});--}}

	{{--</script>--}}

@endpush
@push('pagescript')
	<script>
		var index = $('#custom_stage_id').prop('selectedIndex');
		var select = $('#custom_stage_id');

		var modal = $('#myModal');

		$('#custom_stage_id').on('change', function () {

			$('.close').on('click', function () {
				modal.css('display', 'none');

			});

			$('#message-modal').html(
				'<div> ' +
				'<p>Changing status to:'+$('#custom_stage_id option:selected').text()+ '</p>' +
				'<button id="yes" >Yes</button>' +
				'<button id="no" >No</button>' +
				'</div>'
			);
			modal.css('display', 'block');
			$('button#yes').click(function () {
				var lead_id = $('#lead-id').text();

				axios.patch('{{ route('leads.update-stage') }}', {lead_id: lead_id, stage_id: $('#custom_stage_id').val()})
					.then(function (response) {
						console.log('asf');
						modal.css('display', 'none');
					});
			});
			$('button#no').click(function () {

				$('#custom_stage_id').prop('selectedIndex', index);
				modal.css('display', 'none');
				return false;

			});

		});


	</script>
@endpush