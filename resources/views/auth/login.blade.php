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
            <header class="panel-heading text-center login-heading">{{ get_option('login_title') }}</header>

            @if (settingEnabled('enable_languages'))
            <div class="panel-body text-right clearfix">

                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle btn-{{ get_option('theme_color') }}" data-toggle="dropdown" btn-icon="" title="@langapp('languages')  ">
                    @icon('solid/globe')
                    </button>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle  hidden-nav-xs"
                    data-toggle="dropdown">@langapp('languages')   <span class="caret"></span></button>
                    <!-- Load Languages -->
                    <ul class="dropdown-menu text-left">
                        @foreach (languages() as $lang)
                        @if ($lang['active'] == 1)
                        <li>
                            <a href="{{  route('setLanguage', ['lang' => $lang['code']])  }}"
                                title="{{  ucwords(str_replace('_', ' ', $lang['name']))  }}">
                                {{  ucwords(str_replace('_', ' ', $lang['name']))  }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            
            {!! Form::open(['route' => 'login', 'class' => 'panel-body wrapper-lg']) !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">@langapp('email')</label>
                
                <input id="email" type="email" class="form-control" placeholder="johndoe@example.com" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">@langapp('password')</label>
                <input id="password" type="password" class="form-control" placeholder="@langapp('password')" name="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                
            </div>
            @if(settingEnabled('use_recaptcha'))
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
            @endif
            @endif
            
            <div class="form-group">
                
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @langapp('remember_me')
                    </label>
                </div>
                
            </div>
            <div class="form-group">
                {!! renderButton(langapp('sign_in')) !!}
                
                <a class="btn btn-link pull-right m-t-xs" href="{{ route('password.request') }}">
                    @langapp('forgot_password')
                </a>
                
            </div>
            @if (settingEnabled('social_login'))
                <div class="line line-dashed"></div>
                <p id="social-buttons">
                    @if (!empty(config('services.twitter.client_id')))
                        <a href="{{url('/redirect/twitter')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using Twitter">@icon('brands/twitter')</a>
                    @endif
                    @if (!empty(config('services.facebook.client_id')))
                        <a href="{{url('/redirect/facebook')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using Facebook">@icon('brands/facebook')</a>
                    @endif
                    @if (!empty(config('services.google.client_id')))
                        <a href="{{url('/redirect/google')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using Google">@icon('brands/google')</a>
                    @endif

                    @if (!empty(config('services.github.client_id')))
                        <a href="{{url('/redirect/github')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using Github">@icon('brands/github')</a>
                    @endif

                    @if (!empty(config('services.linkedin.client_id')))
                        <a href="{{url('/redirect/linkedin')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using LinkedIn">@icon('brands/linkedin')</a>
                    @endif

                    @if (!empty(config('services.gitlab.client_id')))
                        <a href="{{url('/redirect/gitlab')}}" class="btn btn-sm btn-icon btn-{{ get_option('theme_color') }} m-xs" data-rel="tooltip" title="Login using Gitlab">@icon('brands/gitlab')</a>
                    @endif
                              
                        
                </p>
            @endif
            
            <div class="line line-dashed"></div>

            @if (settingEnabled('allow_client_registration'))
            <p class="text-muted text-center">
                <small>@langapp('do_not_have_an_account') </small>
            </p>
            <a href="{{ url('/register') }}"
            class="btn btn-{{ get_option('theme_color') }} btn-block">@langapp('get_your_account') </a>
            @endif
            
            
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