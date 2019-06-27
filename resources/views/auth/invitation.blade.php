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
                <header class="panel-heading text-center login-heading"><strong>{{ get_option('company_name') }} @langapp('invitation')</strong>
                </header>

               

                {!! Form::open(['route' => 'invite.accepted', 'class' => 'panel-body wrapper-lg']) !!}

                <input type="hidden" value="{{ $email }}" name="email">
                <input type="hidden" value="{{ $email }}" name="username">
                <input type="hidden" value="1" name="verified">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">@langapp('fullname')</label>
                                <input id="fullname" type="text" class="form-control" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">@langapp('contact_email')</label>
                                <input id="email" type="email" class="form-control" value="{{ $email }}" readonly="readonly">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                            <label for="job_title">@langapp('job_title')</label>
                                <input name="job_title" type="text" class="form-control" placeholder="Project Manager" value="{{ old('job_title') }}">

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">@langapp('password')</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        

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

                        <button type="submit" class="btn btn-{{ get_option('theme_color') }} btn-block">@langapp('accept_invitation') </button>
                        
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
