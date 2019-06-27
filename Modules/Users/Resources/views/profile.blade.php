@extends('layouts.app')
@section('content')
@php
$user = Auth::user();
$channels = !is_null($user->profile->channels) ? $user->profile->channels : [];
@endphp
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                            <p class="h3"><strong>{{ $user->name }}</strong>
                                
                                <a href="{{ route('users.gdpr.export') }}" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right">
                                    @icon('solid/database') GDPR Data
                                </a>
                                <a href="{{ route('users.api') }}" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right">
                                    @icon('solid/code') API Settings
                                </a>
                                <a href="{{ route('users.2fa') }}" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-toggle="ajaxModal">
                                    @icon('solid/fingerprint') 2FAuth
                                </a>
                            </p>
                        </div>
                    </div>
                </header>
                
                <section class="scrollable wrapper bg">
                    @if (Auth::user()->on_holiday)
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="fas fa-info-sign"></i>@langapp('holiday_enabled')
                    </div>
                    @endif
                    
                    <div class="row">
                        {!! Form::open(['route' => 'users.change', 'class' => 'bs-example ajaxifyForm']) !!}
                        <div class="col-lg-6">
                            <section class="panel panel-default">
                                <header class="panel-heading">@langapp('information')
                                    @if($user->profile->company > 0 && $user->profile->business->primary_contact == Auth::id())
                                    <a href="{{ route('contacts.create', Auth::user()->profile->company) }}" class="btn btn-xs btn-success pull-right" data-toggle="ajaxModal" title="Add Contact Person" data-rel="tooltip" data-placement="bottom">@icon('regular/user-circle') @langapp('contact')</a>
                                    @endif

                                    @if(!Auth::user()->hasRole('client'))
                                    @if (Auth::user()->on_holiday)
                                        <a href="{{ route('users.holiday', 'disable') }}" class="btn btn-xs btn-success pull-right" title="@langapp('disable_holiday_mode')" data-rel="tooltip" data-placement="bottom">@icon('solid/plane-arrival') @langapp('disable_holiday')</a>
                                    @else
                                        <a href="{{ route('users.holiday', 'enable') }}" class="btn btn-xs btn-danger pull-right" title="@langapp('enable_holiday_mode')" data-rel="tooltip" data-placement="bottom">@icon('solid/plane-departure') @langapp('enable_holiday')</a>
                                    @endif
                                    
                                    @endif
                                </header>
                                <div class="panel-body">
                                    
                                    <div class="form-group">
                                        <label>@langapp('fullname')  @required</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('hourly_rate') </label>
                                        <input type="text" class="form-control" name="profile[hourly_rate]" value="{{ $user->profile->hourly_rate }}">
                                    </div>
                                    <input type="hidden" value="{{  $user->profile->company }}" name="profile[company]">
                                    @if ($user->profile->company > 0)
                                    <div class="form-group">
                                        <label>@langapp('company')</label>
                                        <input type="text" class="form-control" name="company[name]"
                                        value="{{ optional($user->profile)->business->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label data-rel="tooltip" title="Company Mobile">@langapp('company') @langapp('mobile')</label>
                                        <input type="text" class="form-control" name="company[mobile]"
                                        value="{{ optional($user->profile)->business->mobile  }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('company_email')</label>
                                        <input type="text" class="form-control" name="company[email]"
                                        value="{{ optional($user->profile)->business->email  }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('address1')</label>
                                        <input type="text" class="form-control" name="company[address1]"
                                        value="{{ optional($user->profile)->business->address1 }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('address2')</label>
                                        <input type="text" class="form-control" name="company[address2]"
                                        value="{{ optional($user->profile)->business->address2 }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('tax_number')</label>
                                        <input type="text" class="form-control" name="company[tax_number]"
                                        value="{{ optional($user->profile)->business->tax_number }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Slack URL <span data-rel="tooltip" title="Your company slack webhook">@icon('brands/slack', 'text-info')</span></label>
                                        <input type="text" class="form-control" name="company[slack_webhook_url]"
                                        value="{{ optional($user->profile)->business->slack_webhook_url }}">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label>@langapp('mobile') </label>
                                        <input type="text" class="form-control" name="profile[mobile]" value="{{ $user->profile->mobile }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>@langapp('locale')</label>
                                        <select class="select2-option form-control" name="locale">
                                            @foreach (languages() as $language)
                                            <option value="{{ $language['code'] }}" {{ $user->locale == $language['code'] ? ' selected' : '' }}>{{ ucfirst($language['name']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="profile[use_gravatar]" value="0">
                                    <div class="form-group">
                                        <div class="form-check text-muted">
                                            <label>
                                                <input type="checkbox" name="profile[use_gravatar]" {{ $user->profile->use_gravatar == 1 ? 'checked' : '' }} value="1"> <span class="label-text">Use avatar from Gravatar</span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="thumb-sm avatar pull-right">
                                            <img src="{{ $user->profile->photo }}" width="50" class="img-circle m-sm">
                                        </span>
                                        <label>@langapp('avatar') </label>
                                        <input type="file" name="avatar">
                                        
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="pull-right">
                                            <img class="" src="{{ $user->profile->sign }}" width="50" alt="">
                                        </span>
                                        <label>{{ langapp('signature') }}</label>
                                        <input type="file" name="signature">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('email_signature')</label>
                                        <textarea class="form-control markdownEditor" name="profile[email_signature]" data-hidden-buttons='["cmdHeading", "cmdQuote","cmdCode", "cmdList", "cmdList0"]'>{{ $user->profile->email_signature }}</textarea>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-6">
                            <section class="panel panel-default">
                            <header class="panel-heading">@langapp('authorization')</header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Slack Webhook URL <span data-rel="tooltip" title="Your slack webhook url">@icon('brands/slack', 'text-danger')</span></label>
                                    <input type="text" class="form-control" name="slack_webhook_url" value="{{ $user->slack_webhook_url }}">
                                </div>
                                <div class="form-group">
                                    <label>Calendar Token <a href="{{ route('users.token') }}" class="btn btn-xs btn-info">
                                        @icon('solid/sync-alt')
                                    </a></label>
                                    <input type="text" class="form-control" readonly="readonly"
                                    value="{{ $user->calendar_token }}">
                                </div>
                                <div class="form-group">
                                    <label>@langapp('notification_channels') @required</label>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][slack]" {{ in_array('slack', $channels) ? 'checked' : '' }}> <span class="label-text">@langapp('receive_slack_notifications')</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][mail]" {{ in_array('mail', $channels) ? 'checked' : '' }}> <span class="label-text">@langapp('receive_mail_notifications')</span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][database]" {{ in_array('database', $channels) ? 'checked' : '' }}> <span class="label-text">@langapp('receive_app_notifications')</span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][broadcast]" {{ in_array('broadcast', $channels) ? 'checked' : '' }}> <span class="label-text">@langapp('receive_broadcast_notification')</span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][nexmo]" {{ in_array('nexmo', $channels) ? 'checked' : '' }}> <span class="label-text">@langapp('receive_sms_notification')</span>
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label>@langapp('email')  @required</label>
                                    <input type="email" class="form-control" name="email"
                                    value="{{ $user->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('username')  @required</label>
                                    <input type="text" class="form-control" name="username"
                                    placeholder="@langapp('new_username') " value="{{ $user->username }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('password')</label>
                                    <input type="password" class="form-control" name="password"
                                    placeholder="@langapp('password') ">
                                </div>
                                <div class="form-group">
                                    <label>@langapp('confirm_password')</label>
                                    <input type="password" class="form-control" name="confirm_password"
                                    placeholder="@langapp('confirm_password') ">
                                </div>
                                <div class="form-group">
                                    <label class="text-danger">@icon('solid/exclamation-triangle') @langapp('danger_zone')</label>
                                    <div class="form-check text-danger">
                                        <label>
                                            <input type="checkbox" name="unsubscribed_at" {{ is_null(Auth::user()->unsubscribed_at) ? '' : 'checked' }} value="{{ now()->toDateTimeString() }}">
                                            <span class="label-text" data-rel="tooltip" title="The right to restrict processing">@langapp('do_not_contact_me')</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check text-danger">
                                        <label>
                                            <input type="checkbox" name="deleted_at" value="{{ now()->toDateTimeString() }}">
                                            <span class="label-text" data-rel="tooltip" title="The right to erasure (known as the ‘right to be forgotten’)">@langapp('delete_account_permanent')</span>
                                        </label>
                                    </div>
                                    
                                </div>
                                {!! renderAjaxButton() !!}
                                
                            </div>
                        </section>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>

        </section>

        </aside>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@push('pagestyle')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.markdown')
@include('stacks.js.form')
@endpush
@endsection