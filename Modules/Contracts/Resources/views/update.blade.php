@extends('layouts.app')

@section('content')


<section id="content">
    <section class="hbox stretch">

            <section class="vbox">


                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">

                            <a href="{{ route('contracts.view', ['id' => $contract->id])  }}"
                               class="btn btn-{{ get_option('theme_color') }} btn-sm" data-toggle="tooltip"
                               title="@langapp('preview') " data-placement="bottom">@icon('solid/arrow-alt-circle-left') @langapp('preview')  </a>


                        </div>
                        <div class="col-sm-4 m-b-xs">


                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">

                    <div class="row">


                        <div class="panel-default">


                            <div class="panel-body">

    {!! Form::open(['route' => ['contracts.api.update', $contract->id], 'class' => 'm-b-sm ajaxifyForm', 'method' => 'PUT']) !!}


                                <input type="hidden" name="id" value="{{  $contract->id  }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>@langapp('contract_title') @required</label>
                                            <input type="text" value="{{  $contract->contract_title  }}"
                                                   name="contract_title"
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>@langapp('client') @required</label>
        <select name="client_id" class="form-control select2-option" required>

        @foreach (Modules\Clients\Entities\Client::select('id', 'name')->where('primary_contact', '>', 0)->get() as $client)
                        <option value="{{  $client->id  }}" {{  $client->id === $contract->client_id ? 'selected="selected"' : '' }}>{{ $client->name }}</option>
        @endforeach
        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>@langapp('start_date')  @required</label>

                                            <div class="input-group">

                                                <input class="datepicker-input form-control" size="16" type="text"
                                                       value="{{  datePickerFormat($contract->start_date)  }}"
                                                       name="start_date"
                                                       data-date-format="{{ get_option('date_picker_format') }}"
                                                       required>
                                                <label class="input-group-addon btn" for="date">
                                                    <span class="fa fa-calendar"></span>
                                                </label>
                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <label>@langapp('end_date')   <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input class="datepicker-input form-control" size="16" type="text"
                                                       value="{{  datePickerFormat($contract->end_date)  }}"
                                                       name="end_date" data-date-format="{{ get_option('date_picker_format') }}"
                                                       data-date-start-date="moment()" required>
                                                <label class="input-group-addon btn" for="date">
                                                    <span class="fa fa-calendar"></span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@langapp('fixed_rate')  </label>
                                            <select name="rate_is_fixed" class="form-control">
                                                <option value="0" {{ $contract->rate_is_fixed == '0' ? 'selected="selected"' : '' }}>@langapp('no')  </option>
                                                <option value="1" {{ $contract->rate_is_fixed == '1' ? 'selected="selected"' : '' }}>@langapp('yes')  </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>@langapp('fixed_price')  </label>
                                            <input type="text" value="{{ $contract->fixed_rate }}" class="form-control"
                                                   name="fixed_rate">
                                        </div>
                                        <div class="col-md-4">
                                            <label>@langapp('hourly_rate')  </label>
                                            <input type="text" value="{{ $contract->hourly_rate }}"
                                                   class="form-control"
                                                   name="hourly_rate">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>@langapp('currency')  @required</label>
                                            <select name="currency" class="form-control select2-option" required>
                                                @foreach (App\Entities\Currency::select('code', 'title')->get() as $currency)
                                                    <option value="{{  $currency->code  }}" {{  $currency->code == $contract->currency ? 'selected="selected"' : '' }}>{{ $currency->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>@langapp('i_will_provide_this_service')</label>
                                            <input type="text" name="services"
                                                   value="{{  $contract->services  }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>@langapp('who_will_own_your_work_product') <a href="" data-toggle="tooltip"
                                                                                      title="If your work is ‘made for hire’, your client is considered the author, and owns all copyrights to the work."
                                                                                      data-placement="right">
                                                                                          @icon('regular/question-circle')
                                                                                      </a></label>
                                            <select name="license_owner" class="form-control">
                                                <option value="client" {{ $contract->license_owner == 'client' ? 'selected="selected"' : '' }}>
                                                    @langapp('made_for_hire_owned_by_client')
                                                </option>
                                                <option value="freelancer" {{ $contract->license_owner == 'freelancer' ? 'selected="selected"' : '' }}>
                                                    @langapp('i_will_retain_ownership')
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>@langapp('how_long_should_client_take_to_countersign') <span class="text-danger">*</span> </label>
                                            <input type="text"
                                                   value="{{  diffDays($contract->start_date, $contract->expiry_date)  }}"
                                                   class="form-control"
                                                   name="expiry_date" required>
                                            <span class="help-block text-danger">@langapp('days'). @langapp('selected_expiration_date_after_start_date')</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>@langapp('description')   <a href="" data-toggle="tooltip" title="@langapp('services_you_will_provide')" data-placement="right">@icon('regular/question-circle')</a></label>
                                            <textarea name="description" name="description"
                                                      class="form-control markdownEditor">{{  $contract->description  }}</textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label>@langapp('client_granted_rights')</label>
                                            <textarea name="client_rights"
                                                      class="form-control markdownEditor">{{ $contract->client_rights }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@langapp('payment_terms')</label>
                                            <input type="text" value="{{  $contract->payment_terms  }}"
                                                   class="form-control"
                                                   name="payment_terms">
                                            <span class="help-block text-danger">Enter number of Days</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label>@langapp('late_fee')</label>
                                            <input type="text" value="{{  $contract->late_payment_fee  }}"
                                                   name="late_payment_fee"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>@langapp('late_fee_percent')</label>
                                            <select name="late_fee_percent" class="form-control">
                                                <option value="0" {{ $contract->late_fee_percent === 0 ? 'selected="selected"' : '' }}>@langapp('no')  </option>
                                                <option value="1" {{ $contract->late_fee_percent === 1 ? 'selected="selected"' : '' }}>@langapp('yes')  </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>@langapp('project_termination_period')</label>
                                            <input type="text" value="{{  $contract->termination_notice  }}"
                                                   class="form-control" name="termination_notice">
                                            <span class="help-block text-danger">Enter number of Days</span>
                                        </div>
                                        <div class="col-md-3">
                                            <label>@langapp('cancellation_fee') <a href="#" data-toggle="tooltip"
                                                                       title="If your Client terminates your contract earlier without cause, you may charge a cancellation fee, commonly known as a 'kill fee'. Note that this cannot be unreasonable or punitive. You should consult an attorney to determine if your proposed cancellation fee would be legally enforceable."
                                                                       data-placement="top">@icon('regular/question-circle')</a></label>
                                            <input type="text" value="{{ $contract->cancelation_fee }}"
                                                   class="form-control"
                                                   name="cancelation_fee">
                                        </div>
                                        <div class="col-md-3">
                                            <label>@langapp('required_deposit') <a href="#" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Getting money up front helps mitigate your risk in taking on work. We recommend that freelancers negotiate a deposit, especially for larger projects.">
                                                                   @icon('regular/question-circle')</a></label>
                                            <input type="text" value="{{ $contract->deposit_required }}"
                                                   name="deposit_required" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label>@langapp('right_to_include_in_portfolio') <a href="#" data-toggle="tooltip"
                                                                                    data-placement="left"
                                                                                    title="Retain right to include work attribution in your portfolio.">
                                                                                @icon('regular/question-circle')</a></label>
                                            <select name="portfolio_rights" class="form-control">
                                                <option value="1" {{  $contract->portfolio_rights === 1 ? 'selected="selected"' : '' }}>
                                                    @langapp('yes')
                                                </option>
                                                <option value="0" {{  $contract->portfolio_rights === 0 ? 'selected="selected"' : '' }}>
                                                    @langapp('no')
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>@langapp('add_noncompete')</label>
                                            <select name="non_compete" class="form-control">
                                                <option value="1" {{ $contract->non_compete === 1 ? 'selected="selected"' : '' }}>@langapp('yes')</option>
                                                <option value="0" {{ $contract->non_compete === 0 ? 'selected="selected"' : '' }}>@langapp('no')</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>@langapp('limit_revisions')</label>
                                            <input type="text" value="{{ $contract->feedbacks }}" class="form-control" name="feedbacks" required>
                                            <span class="help-block text-danger">Default is 0 i.e no revision limits</span>
                                        </div>

                                        <div class="col-md-4">
                                            <label>@langapp('add_sexual_harrassment')</label>
                                            <select name="appropriate_conduct" class="form-control">
                                                <option value="1" {{ $contract->appropriate_conduct === 1 ? 'selected="selected"' : '' }}>@langapp('yes')</option>
                                                <option value="0" {{ $contract->appropriate_conduct === 0 ? 'selected="selected"' : '' }}>@langapp('no')</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="text-right">
                                    {!! renderAjaxButton() !!}
                                </div>


                                {!! Form::close() !!}


                            </div>


                        </div>

                </section>


            </section>




</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav">
</a> 
</section>

@push('pagestyle')
    <link href="//fonts.googleapis.com/css?family=Dawning+of+a+New+Day" rel="stylesheet">
    @include('stacks.css.form')
    @include('stacks.css.datepicker')
@endpush

@push('pagescript')
    @include('stacks.js.form')
    @include('stacks.js.datepicker')
    @include('stacks.js.markdown')
@endpush
@endsection