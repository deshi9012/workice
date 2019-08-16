<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			ssss
			{{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
			{{--<h4 class="modal-title">@langapp('make_changes') - {{ $lead->name }}</h4>--}}
		{{--</div>--}}
		{{--{!! Form::open(['route' => ['leads.api.update', $lead->id ], 'class' => 'ajaxifyForm', 'method' => 'PUT', 'data-toggle' => 'validator', 'novalidate' => '']) !!}--}}
		{{--<div class="modal-body">--}}
			{{--<ul class="nav nav-tabs" role="tablist">--}}
				{{--<li class="active"><a data-toggle="tab" href="#tab-lead-general">@langapp('general') </a></li>--}}
				{{--<li><a data-toggle="tab" href="#tab-lead-location">@langapp('location')</a></li>--}}
				{{--<li><a data-toggle="tab" href="#tab-lead-web">@langapp('web') </a></li>--}}
				{{--<li><a data-toggle="tab" href="#tab-lead-message">@langapp('message') </a></li>--}}
				{{--<li><a data-toggle="tab" href="#tab-lead-custom">@langapp('custom_fields') </a></li>--}}
			{{--</ul>--}}
			{{--<div class="tab-content">--}}
				{{--<div class="tab-pane fade in active" id="tab-lead-general">--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
						{{--<label>@langapp('fullname') @required</label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager'))--}}
							{{--<input type="text" name="name" value="{{ $lead->name }}" class="input-sm form-control"--}}
								   {{--required>--}}
						{{--@else--}}
							{{--<input type="text" name="name" value="{{ $lead->name }}" class="input-sm form-control"--}}
								   {{--readonly>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
						{{--<label>@langapp('email') @required</label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager'))--}}
							{{--<input type="email" name="email" value="{{ $lead->email }}" class="input-sm form-control"--}}
								   {{--required>--}}
						{{--@else--}}
							{{--<input type="email" name="email" value="{{ $lead->email }}" class="input-sm form-control"--}}
								   {{--readonly>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
						{{--<label>@langapp('mobile') </label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
							{{--<input type="text" name="mobile" class="input-sm form-control" value="{{ $lead->mobile }}">--}}
						{{--@else--}}
							{{--<input type="text" name="mobile" class="input-sm form-control" value="{{ $lead->mobile }}"--}}
								   {{--readonly>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="col-md-6">--}}
						{{--<label>Desk @required</label>--}}

						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager'))--}}

							{{--<select class="select2-option form-control" name="desk">--}}
								{{--@foreach (App\Entities\Desk::all() as $desk)--}}
									{{--<option value="{{  $desk->id  }}" {{ $desk->id == $lead->desk_id ? 'selected' : ''}}>{{  $desk->name }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--@else--}}
							{{--<input type="hidden" name="desk" value={{$lead->desk_id}}/>--}}

							{{--<select class="select2-option form-control" name="desk" disabled>--}}
								{{--@foreach (App\Entities\Desk::all() as $desk)--}}
									{{--<option value="{{  $desk->id  }}"--}}
											{{--{{ $desk->id == $lead->desk_id ? ' selected' : ''}} > {{  $desk->name }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('company_name')  </label>--}}
					{{--<input type="text" name="company" class="input-sm form-control" value="{{ $lead->company }}">--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
						{{--<label>@langapp('source') </label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
							{{--<select name="source" class="form-control">--}}
								{{--@foreach (App\Entities\Category::select('id', 'name')->whereModule('source')->get() as $source)--}}
									{{--<option value="{{ $source->id }}" {{ $source->id == $lead->source ? ' selected' : '' }}>{{ $source->name }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--@else--}}
							{{--<select name="source" class="form-control" readonly="readonly">--}}
								{{--@foreach (App\Entities\Category::select('id', 'name')->whereModule('source')->get() as $source)--}}
									{{--<option value="{{ $source->id }}" {{ $source->id == $lead->source ? ' selected' : '' }}>{{ $source->name }}</option>--}}
								{{--@endforeach--}}
							{{--</select>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
						{{--<label>@langapp('stage')</label>--}}
						{{--<select name="stage_id" class="form-control">--}}
							{{--@foreach (App\Entities\Category::leads()->get() as $stage)--}}
								{{--<option value="{{ $stage->id }}" {{ $stage->id == $lead->stage_id ? ' selected' : '' }}>{{ ucfirst($stage->name) }}</option>--}}
							{{--@endforeach--}}
						{{--</select>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
						{{--<label>Language</label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
							{{--<input type="text" name="language" class="input-sm form-control"--}}
								   {{--value="{{ $lead->language }}">--}}
						{{--@else--}}
							{{--<input type="text" name="language" class="input-sm form-control"--}}
								   {{--value="{{ $lead->language }}" readonly>--}}
						{{--@endif--}}
					{{--</div>--}}

					{{--<div class="form-group col-md-6 no-gutter-right">--}}
						{{--<label>Courses</label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
							{{--<input type="text" name="courses" class="input-sm form-control"--}}
								   {{--value="{{ $lead->courses }}">--}}
						{{--@else--}}
							{{--<input type="text" name="courses" class="input-sm form-control" value="{{ $lead->courses }}"--}}
								   {{--readonly>--}}
						{{--@endif--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
						{{--<label>Sales Status</label>--}}
						{{--<input type="text" name="sales_status" class="input-sm form-control" value="{{ $lead->sales_status }}">--}}
						{{--<select class="form-control select2-option" name="sales_status" required>--}}

						{{--@foreach (statuses() as $status)--}}
						{{--<option value="{{  $status  }}"  {{ $lead->sales_status == $status ? ' selected' : '' }} >{{  $status }}</option>--}}

						{{--@endforeach--}}
						{{--</select>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
						{{--<label>Change password</label>--}}
						{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
							{{--<input type="text" name="change_password" class="input-sm form-control" value="">--}}
						{{--@else--}}
							{{--<input type="text" name="change_password" class="input-sm form-control" value="" readonly>--}}
						{{--@endif--}}
					{{--</div>--}}

					{{--<div class="row">--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('lead_score') <span class="text-muted">(In % Ex. 50)</span>--}}
							{{--</label>--}}
							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager'))--}}
								{{--<input type="text" value="{{ $lead->lead_score }}" name="lead_score"--}}
									   {{--class="input-sm form-control">--}}
							{{--@else--}}
								{{--<input type="text" value="{{ $lead->lead_score }}" name="lead_score"--}}
									   {{--class="input-sm form-control" readonly>--}}
							{{--@endif--}}
						{{--</div>--}}

						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('lead_value')</label>--}}
							{{--<input type="text" value="{{ $lead->lead_value }}" name="lead_value"--}}
								   {{--class="input-sm form-control">--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('sales_rep')</label>--}}

							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('sales team leader') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager'))--}}
								{{--<select class="select2-option form-control" name="sales_rep" required>--}}
									{{--@foreach (app('user')->get() as $user)--}}
										{{--<option value="{{ $user->id }}" {{ $user->id == $lead->sales_rep ? ' selected' : '' }}>{{  $user->name }}</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@else--}}
								{{--<input type="hidden" name="sales_rep" value={{$lead->sales_rep}}/>--}}
								{{--<select class="select2-option form-control" name="sales_rep" required disabled>--}}
									{{--@foreach (app('user')->get() as $user)--}}

										{{--<option value="{{ $user->id }}"{{ $lead->sales_rep == $user->id ? ' selected' : '' }}>{{  $user->name }}</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@endif--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>{{ langapp('timezone') }} </label>--}}
							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
								{{--<select class="select2-option form-control" name="timezone" required>--}}
									{{--@foreach (timezones() as $timezone => $description)--}}
										{{--<option value="{{ $timezone }}"{{  $lead->timezone == $timezone ? ' selected' : ''  }}>{{  $description  }}</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@else--}}
								{{--<input type="hidden" name="timezone" value={{$lead->timezone}} >--}}
								{{--<select class="select2-option form-control" name="timezone" disabled>--}}
									{{--@foreach (timezones() as $timezone => $description)--}}
										{{--<option value="{{ $timezone }}"{{  $lead->timezone == $timezone ? ' selected' : ''  }}>{{  $description  }}</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@endif--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('state') </label>--}}
							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
								{{--<input type="text" value="{{ $lead->state }}" name="state"--}}
									   {{--class="input-sm form-control">--}}
							{{--@else--}}
								{{--<input type="text" value="{{ $lead->state }}" name="state" class="input-sm form-control"--}}
									   {{--readonly>--}}
							{{--@endif--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
							{{--<label>@langapp('country') </label>--}}
							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
								{{--<select class="form-control select2-option" name="country">--}}
									{{--@foreach (countries() as $country)--}}
										{{--<option value="{{ $country['name'] }}" {{ $country['name'] == $lead->country ? 'selected' : '' }}>{{ $country['name'] }}--}}
										{{--</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@else--}}
								{{--<input type="hidden" name="country" value={{$lead->country}}/>--}}

								{{--<select class="form-control select2-option" name="country" disabled>--}}
									{{--@foreach (countries() as $country)--}}
										{{--<option value="{{ $country['name'] }}" {{ $country['name'] == $lead->country ? 'selected' : '' }}>{{ $country['name'] }}--}}
										{{--</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@endif--}}

						{{--</div>--}}
						{{--<div class="form-group col-md-11">--}}
							{{--<label>@langapp('tags') </label>--}}
							{{--@if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager'))--}}
								{{--<select class="select2-tags form-control" name="tags[]" multiple="multiple">--}}
									{{--@foreach (App\Entities\Tag::all() as $tag)--}}
										{{--<option value="{{ $tag->name }}" {{ in_array($tag->id, array_pluck($lead->tags->toArray(), 'id')) ? ' selected' : '' }}>--}}
											{{--{{ $tag->name }}--}}
										{{--</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@else--}}
								{{--<input type="hidden" name="country" value={{$lead->country}}/>--}}


								{{--<select class="select2-tags form-control" name="tags[]" multiple="multiple" disabled>--}}
									{{--@foreach (App\Entities\Tag::all() as $tag)--}}
										{{--<option value="{{ $tag->name }}" {{ in_array($tag->id, array_pluck($lead->tags->toArray(), 'id')) ? ' selected' : '' }}>--}}
											{{--{{ $tag->name }}--}}
										{{--</option>--}}
									{{--@endforeach--}}
								{{--</select>--}}
							{{--@endif--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="tab-pane fade in" id="tab-lead-location">--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('phone')  </label>--}}
					{{--<input type="text" value="{{ $lead->phone }}" name="phone" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('job_title')  </label>--}}
					{{--<input type="text" value="{{ $lead->job_title }}" name="job_title" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="clearfix"></div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('address')  1</label>--}}
					{{--<textarea name="address1" class="form-control">{{ $lead->address1 }}</textarea>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('address')  2</label>--}}
					{{--<textarea name="address2" class="form-control">{{ $lead->address2 }}</textarea>--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-left">--}}
					{{--<label>@langapp('city')  </label>--}}
					{{--<input type="text" value="{{ $lead->city }}" name="city" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group col-md-6 no-gutter-right">--}}
					{{--<label>@langapp('zipcode')  </label>--}}
					{{--<input type="text" value="{{ $lead->zip_code }}" name="zip_code" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="row">--}}
						{{--<div class="form-group col-md-6">--}}
						{{--<label>@langapp('state') </label>--}}
						{{--<input type="text" value="{{ $lead->state }}" name="state" class="input-sm form-control">--}}
						{{--</div>--}}
						{{--<div class="form-group col-md-6">--}}
						{{--<label>@langapp('country') </label>--}}
						{{--<select class="form-control select2-option" name="country">--}}
						{{--@foreach (countries() as $country)--}}
						{{--<option value="{{ $country['name'] }}" {{ $country['name'] == $lead->country ? 'selected' : '' }}>{{ $country['name'] }}--}}
						{{--</option>--}}
						{{--@endforeach--}}
						{{--</select>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="tab-pane fade in" id="tab-lead-web">--}}
					{{--<div class="form-group">--}}
						{{--<label>@langapp('website') </label>--}}
						{{--<input type="text" value="{{ $lead->website }}" name="website" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group">--}}
						{{--<label>Skype</label>--}}
						{{--<input type="text" value="{{ $lead->skype }}" name="skype" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group">--}}
						{{--<label>LinkedIn</label>--}}
						{{--<input type="text" value="{{ $lead->linkedin }}" name="linkedin" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group">--}}
						{{--<label>Facebook</label>--}}
						{{--<input type="text" value="{{ $lead->facebook }}" name="facebook" class="input-sm form-control">--}}
					{{--</div>--}}
					{{--<div class="form-group">--}}
						{{--<label>Twitter</label>--}}
						{{--<input type="text" value="{{ $lead->twitter }}" name="twitter" class="input-sm form-control">--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="tab-pane fade in" id="tab-lead-message">--}}
					{{--<div class="form-group">--}}
						{{--<label>@langapp('message') </label>--}}
						{{--<textarea name="message" class="form-control markdownEditor"--}}
								  {{--required>{{ $lead->message }} </textarea>--}}
					{{--</div>--}}

				{{--</div>--}}
				{{--<div class="tab-pane fade in" id="tab-lead-custom">--}}
					{{--@php--}}
						{{--$data['fields'] = App\Entities\CustomField::whereModule('leads')->orderBy('order', 'desc')->get();--}}
					{{--@endphp--}}
					{{--@include('leads::_includes.updateCustom', $data)--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<div class="modal-footer">--}}
				{{--{!! closeModalButton() !!}--}}
				{{--{!! renderAjaxButton() !!}--}}
			</div>
			{{--{!! Form::close() !!}--}}
		</div>
	</div>

{{--@push('pagestyle')--}}
	{{--@include('stacks.css.form')--}}
{{--@endpush--}}
{{--@push('pagescript')--}}
	{{--@include('stacks.js.form')--}}
	{{--@include('stacks.js.markdown')--}}
	{{--@include('partial.ajaxify')--}}
{{--@endpush--}}

{{--@stack('pagestyle')--}}
{{--@stack('pagescript')--}}