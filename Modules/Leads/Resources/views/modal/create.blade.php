<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">@langapp('lead') </h4>
		</div>
		{!! Form::open(['route' => 'leads.api.save', 'class' => 'ajaxifyForm', 'data-toggle' => 'validator', 'novalidate' => '']) !!}
		<div class="modal-body">

			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab-lead-general" data-toggle="tab">@langapp('general') </a></li>
				{{--<li><a href="#tab-lead-location" data-toggle="tab">@langapp('location')</a></li>--}}
				{{--<li><a href="#tab-lead-web" data-toggle="tab">@langapp('web') </a></li>--}}
				{{--<li><a href="#tab-lead-message" data-toggle="tab">@langapp('message') </a></li>--}}
				{{--<li><a href="#tab-lead-custom" data-toggle="tab">@langapp('custom_fields') </a></li>--}}
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-lead-general">
					<div class="form-group col-md-6 no-gutter-left">
						<label>@langapp('fullname') @required</label>
						<input type="text" name="name" value="" class="input-sm form-control" required>
					</div>
					<div class="form-group col-md-6 no-gutter-right">
						<label>@langapp('email') @required</label>
						<input type="email" name="email" value="" class="input-sm form-control" required>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						<label>@langapp('mobile') </label>
						<input type="text" name="mobile" class="input-sm form-control">
					</div>
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('company_name')  </label>--}}
					{{--<input type="text" value="" name="company" class="input-sm form-control">--}}
					{{--</div>--}}

					<div class="form-group col-md-6 no-gutter-right">
						<label>@langapp('source') @required</label>
						<select name="source" class="form-control">
							@foreach (App\Entities\Category::select('id', 'name')->whereModule('source')->get() as $source)
								<option value="{{ $source->id }}">{{ $source->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						<label>@langapp('stage') @required</label>
						<select name="stage_id" class="form-control">
							@foreach (App\Entities\Category::leads()->orderBy('order')->get() as $stage)
								<option value="{{ $stage->id }}">{{ ucfirst($stage->name) }}</option>
							@endforeach
						</select>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Language</label>
							<input type="text" name="language" class="input-sm form-control">
						</div><div class="form-group col-md-6">
							<label>Courses</label>
							<input type="text" name="language" class="input-sm form-control">
						</div>
					</div>
					{{--<div class="row">--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>Sales Status</label>--}}
							{{--<input type="text" name="sales_status" class="input-sm form-control">--}}
							{{--<select class="form-control select2-option" name="sales_status" required>--}}
								{{--@foreach (statuses() as $status)--}}
									{{--<option value="{{  $status  }}" >{{  $status }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--</div>--}}
					{{--</div>--}}

					<div class="row">
						<div class="form-group col-md-6">
							<label>@langapp('lead_score') <span class="text-muted">(In % Ex. 50)</span>
							</label>
							<input type="text" value="10" name="lead_score" class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label>@langapp('lead_value') </label>
							<input type="text" value="0.00" name="lead_value" class="input-sm form-control money">
						</div>
						<div class="form-group col-md-6">
							<label>@langapp('sales_rep') @required </label>
							<select class="form-control select2-option" name="sales_rep" required>

								@foreach (app('user')->permission('leads_create')->offHoliday()->get() as $user)
									<option value="{{ $user->id }}" {{ $user->id == get_option('default_sales_rep') ? 'selected="selected"' : '' }}>{{  $user->name }}</option>
								@endforeach

							</select>

						</div>


						<div class="form-group col-md-6">
							<label>@langapp('timezone') </label>
							<select class="form-control select2-option" name="timezone" required>
								@foreach (timezones() as $timezone => $description)
									<option value="{{  $timezone  }}"{{  get_option('timezone') == $timezone ? ' selected="selected"' : ''  }}>{{  $description  }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>@langapp('state') </label>
							<input type="text" value="" name="state" class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label>@langapp('country')</label>
							<select class="form-control select2-option" name="country">
								@foreach (countries() as $country)
									<option value="{{ $country['name'] }}" {{ $country['name'] == get_option('company_country') ? 'selected' : '' }}>{{ $country['name'] }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-md-11">
							<label>@langapp('tags') </label>
							<select class="select2-tags form-control" name="tags[]" multiple="multiple">
								@foreach (App\Entities\Tag::all() as $tag)
									<option value="{{  $tag->name  }}">{{  $tag->name }}</option>
								@endforeach
							</select>
						</div>

					</div>

				</div>
				<div class="tab-pane fade in" id="tab-lead-location">
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('phone')  </label>--}}
					{{--<input type="text" value="" name="phone" class="input-sm form-control">--}}
					{{--</div>--}}

					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('job_title')</label>--}}
					{{--<input type="text" value="" name="job_title" class="input-sm form-control">--}}
					{{--</div>--}}

					{{--<div class="clearfix"></div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('address')  1</label>--}}
					{{--<textarea name="address1" class="form-control"></textarea>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('address')  2</label>--}}
					{{--<textarea name="address2" class="form-control"></textarea>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('city')  </label>--}}
					{{--<input type="text" value="" name="city" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('zipcode')  </label>--}}
					{{--<input type="text" value="" name="zip_code" class="input-sm form-control">--}}
					{{--</div>--}}
					<div class="row">
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('state') </label>--}}
							{{--<input type="text" value="" name="state" class="input-sm form-control">--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('country')</label>--}}
							{{--<select class="form-control select2-option" name="country">--}}
								{{--@foreach (countries() as $country)--}}
									{{--<option value="{{ $country['name'] }}" {{ $country['name'] == get_option('company_country') ? 'selected' : '' }}>{{ $country['name'] }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--</div>--}}
					</div>

				</div>
				<div class="tab-pane fade in" id="tab-lead-web">
					<div class="form-group">
						<label>@langapp('website') </label>
						<input type="text" value="" name="website" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Skype</label>
						<input type="text" value="" name="skype" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>LinkedIn</label>
						<input type="text" value="" name="linkedin" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" value="" name="facebook" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Twitter</label>
						<input type="text" value="" name="twitter" class="input-sm form-control">
					</div>
				</div>

				<div class="tab-pane fade in" id="tab-lead-message">
					<div class="form-group">
						<label>@langapp('message') </label>
						<textarea name="message" class="form-control markdownEditor" required></textarea>
					</div>


				</div>

				<div class="tab-pane fade in" id="tab-lead-custom">
					@php
						$data['fields'] = App\Entities\CustomField::whereModule('leads')->get();
					@endphp
					@include('partial.customfields.createNoCol', $data)
				</div>
			</div>

			@include('partial.privacy_consent')

			<div class="modal-footer">

				{!! closeModalButton() !!}
				{!! renderAjaxButton() !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>

	@push('pagestyle')
		@include('stacks.css.form')
	@endpush
	@push('pagescript')
		<script>
			$('.money').maskMoney({allowZero: true, thousands: ''});
		</script>
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('partial.ajaxify')
@endpush


@stack('pagestyle')
@stack('pagescript')