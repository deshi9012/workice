@extends('layouts.auth')

@section('content')


    <section id="content" class="m-t-lg wrapper-md content">

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

            <section class="panel panel-default bg-white m-t-lg b-r-cust">
                <header class="panel-heading text-center"><strong>@langapp('confirm_password_to_continue')</strong>
                </header>
                

                <form class="panel-body wrapper-lg" method="POST" action="{{ route('users.reauthenticate.process') }}">
                        {{ csrf_field() }}


                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">@langapp('password')</label>

                            <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

            

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    @icon('solid/unlock-alt') @langapp('confirm_password')</button>

                <p class="text-muted m-t-sm"><strong>Tip:</strong> You are entering sudo mode. You will not be asked for your password for a few hours.</p>
                                    
                                

                            
                        </div>


                        <div class="line line-dashed">
                </div>

                </form>

                @if (!settingEnabled('hide_branding')) 
                    <footer id="footer" class="copyright-footer">
                        <div class="text-center text-muted padder">
                            <p>
                                @include('partial.copyright')
                            </p>
                        </div>
                    </footer>
                @endif

            </section>

        </div>
    </section>

@endsection
