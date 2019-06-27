@extends('layouts.auth')
@section('content')
<section id="content" class="wrapper-md content">
  <div id="login-darken"></div>
  <div id="login-form" class="container aside-xxl animated fadeInUp">
    <span class="navbar-brand block {{ settingEnabled('blur_login') ? 'text-white' : '' }}">
      @php $display = get_option('logo_or_icon'); @endphp
      @if ($display == 'logo' || $display == 'logo_title')
      <img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo')) }}"
      class="img-responsive {{ ($display == 'logo' ? '' : 'thumb-sm m-r-sm') }}">
      @elseif ($display == 'icon' || $display == 'icon_title')
      <i class="{{ get_option('site_icon') }}"></i>
      @endif
      @if ($display == 'logo_title' || $display == 'icon_title')
      @if (get_option('website_name') == '')
      {{ get_option('company_name') }}
      @else
      {{ get_option('website_name') }}
      @endif
      @endif
    </span>
    <section class="panel panel-default bg-white m-t-sm b-r-xs">
    <header class="panel-heading text-center login-heading">@langapp('contact_us')
      @if (!empty(get_option('company_domain')))
        <a href="{{ get_option('company_domain') }}" class="btn btn-xs btn-info pull-right">@icon('solid/home') @langapp('home')</a>
      @endif
      
    </header>
    
    {!! Form::open(['route' => 'web.lead.save', 'class' => 'panel-body wrapper-lg']) !!}
    @if(Session::has('message'))
    <div class="alert alert-success">
      @icon('solid/check-circle') {{ Session::get('message') }}
    </div>
    @else
    <div class="alert alert-info">
      @langapp('lead_info_message')
    </div>
    @endif
    <div class="form-group pull-in clearfix">
      <div class="col-sm-6">
        <label>@langapp('name') @required</label>
        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-sm-6">
        <label>@langapp('email') @required</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="form-group pull-in clearfix">
      <div class="col-sm-6">
        <label>@langapp('phone') </label>
        <input type="text" class="form-control" placeholder="+1XXXXXXXX" value="{{ old('phone') }}" name="phone">
        @if ($errors->has('phone'))
        <span class="help-block">
          <strong>{{ $errors->first('phone') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-sm-6">
        <label>@langapp('company')</label>
        <input type="text" class="form-control" placeholder="Acme Limited" value="{{ old('company') }}" name="company">
        @if ($errors->has('company'))
        <span class="help-block">
          <strong>{{ $errors->first('company') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label>@langapp('website')</label>
      <input type="text" class="form-control" placeholder="Your website url" name="website" value="{{ old('website') }}">
    </div>
    <div class="form-group">
      <label>@langapp('message')</label>
      <textarea class="form-control" rows="6" data-minwords="6" placeholder="Type your message" name="message">{{ old('message') }}</textarea>
    </div>
    
    @if(settingEnabled('lead_recaptcha'))
    {!! NoCaptcha::display() !!}
    @if ($errors->has('g-recaptcha-response'))
    <span class="help-block text-danger">
      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
    </span>
    @endif
    @endif
    
    <div class="form-group {{ $errors->has('agree_terms') ? ' has-error' : '' }}">
      
      <div class="checkbox">
        <label>
          <input type="checkbox" name="agree_terms" {{ old('agree_terms') ? 'checked' : '' }}>
          <span class="label-text">Agree to terms and <a href="{{ get_option('privacy_policy_url') }}" target="_blank">privacy policy</a></span>
        </label>
      </div>
      @if ($errors->has('agree_terms'))
      <span class="help-block">
        <strong>{{ $errors->first('agree_terms') }}</strong>
      </span>
      @endif
      
    </div>

    @if(settingEnabled('lead_recaptcha'))
{!! NoCaptcha::renderJs(getLocaleUsingLanguage(get_option('default_language'))) !!}
@endif

    <div class="form-group">
      {!! renderButton(langapp('submit')) !!}
      
    </div>
    
    
    {!! Form::close() !!}
    
    {{-- Footer --}}
    @if (!settingEnabled('hide_branding'))
    @include('partial.branding')
    @endif
    {{-- /Footer --}}
  </section>
</div>
</section>
@endsection