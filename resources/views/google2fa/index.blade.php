@extends('layouts.auth')
@section('content')
<div class="content">
    <section id="content" class="m-t-lg wrapper-md m-t-cust">
        <div id="login-darken"></div>
        <div id="login-form" class="container aside-xxl animated fadeInUp">
            <span class="navbar-brand block {{  (get_option('blur_login') == 'TRUE') ? 'text' : '' }}">
                @php $display = get_option('logo_or_icon'); @endphp
                @if ($display == 'logo' || $display == 'logo_title')
                <img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo')) }}"
                class="img-responsive {{ ($display == 'logo' ? '' : 'thumb-sm m-r-sm') }}">
                @elseif ($display == 'icon' || $display == 'icon_title')
                @icon('solid/'.get_option('site_icon'))
                @endif
                @if ($display == 'logo_title' || $display == 'icon_title')
                @if (get_option('website_name') == '')
                {{ get_option('company_name') }}
                @else
                {{ get_option('website_name') }}
                @endif
                @endif
            </span>
            <section class="panel panel-default bg-white-cust m-t-lg b-r-cust">
                <header class="panel-heading text-center"><strong>@langapp('2fa_authentication')</strong>
                </header>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('2fa.auth') }}">
                        {{ csrf_field() }}
                        @if ($errors->has('message'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $errors->first('message') }}
                        </div>
                        @endif
                        <p>@langapp('enter_auth_code')</p>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="one_time_password" type="text" class="form-control" name="one_time_password" required autofocus>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">@langapp('login')</button>
                        <div class="m-sm">
                            <a href="{{ url('/logout') }}">@langapp('cancel')</a> | <a href="{{ route('2fa.reset') }}">@langapp('reset_2fa')</a>
                        </div>
                        
                    </form>
                </div>
                {{-- footer --}}
                @if (get_option('hide_branding') == 'FALSE')
                <footer id="footer copyright-footer">
                    <div class="text-center text-muted padder">
                        <p>
                            @include('partial.copyright')
                        </p>
                    </div>
                </footer>
                @endif
               {{-- /footer --}}
            </section>
        </div>
    </section>
</div>
@endsection