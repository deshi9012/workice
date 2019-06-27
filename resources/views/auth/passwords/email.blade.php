@extends('layouts.auth')

@section('content')


    <section id="content" class="wrapper-md content">


        <div id="login-darken"></div>
        <div id="login-form" class="container aside-xxl animated fadeInUp">

    <span class="navbar-brand block {{  settingEnabled('blur_login') ? 'text-white' : '' }}">
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
                <header class="panel-heading text-center login-heading"><strong>{{ get_option('company_name') }} @langapp('reset_password')</strong>
                </header>

        
            
                {!! Form::open(['route' => 'password.email', 'class' => 'panel-body wrapper-lg']) !!}

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">@langapp('email') @required</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        

                        <button type="submit" class="btn btn-{{ get_option('theme_color') }} btn-block">@langapp('send_reset_password') </button>

                        <a href="{{ route('login') }}" class="btn btn-success btn-block">@langapp('login') </a>

                        
                    {!! Form::close() !!}

                    {{-- Footer --}}
                @if (!settingEnabled('hide_branding')) 
                    @include('partial.branding')
                @endif
                {{-- /Footer --}}

                
            
        

    </section>
    
</section>
@endsection
