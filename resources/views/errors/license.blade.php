<!DOCTYPE html>
<html lang="@langapp('lang_code') " class="bg-dark">
<head>
    <meta charset="utf-8"/>
    <?php $favicon = get_option('site_favicon');
    $ext = substr($favicon, -4); ?>

    @if ($ext == '.ico')
        <link rel="shortcut icon" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
    @endif
    @if ($ext == '.png') 
        <link rel="icon" type="image/png" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
    @endif
    @if ($ext == '.jpg' || $ext == 'jpeg')
        <link rel="icon" type="image/jpeg" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
    @endif
    @if (get_option('site_appleicon') != '')
        <link rel="apple-touch-icon" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
        <link rel="apple-touch-icon" sizes="72x72" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
        <link rel="apple-touch-icon" sizes="114x114" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
        <link rel="apple-touch-icon" sizes="144x144" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
    @endif

    <title>{{ config('app.name', 'WorkiceCRM') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="author" content="{{ get_option('site_author') }}">
    <meta name="keywords" content="{{ get_option('site_keywords') }}">
    <meta name="description" content="{{ get_option('site_desc') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ getAsset('css/theme.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ getAsset('css/app.css') }}" type="text/css"/>

    <link rel="stylesheet" href="{{ getAsset('plugins/toastr/toastr.min.css') }}" type="text/css"/>


    <?php
    $family = 'Lato';
    $font = get_option('system_font');
    switch ($font) {
        case 'open_sans':
            $family = 'Open Sans';
            echo "<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext,greek-ext,cyrillic-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'open_sans_condensed':
            $family = 'Open Sans Condensed';
            echo "<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'roboto':
            $family = 'Roboto';
            echo "<link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'roboto_condensed':
            $family = 'Roboto Condensed';
            echo "<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'ubuntu':
            $family = 'Ubuntu';
            echo "<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,500,700&subset=latin,greek-ext,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'lato':
            $family = 'Lato';
            echo "<link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'oxygen':
            $family = 'Oxygen';
            echo "<link href='//fonts.googleapis.com/css?family=Oxygen:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'pt_sans':
            $family = 'PT Sans';
            echo "<link href='//fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'source_sans':
            $family = 'Source Sans Pro';
            echo "<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>";
            break;
        case 'muli':
            $family = 'Muli';
            echo "<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet'>";
            break;
    }
    ?>
    <style type="text/css">
        body {
            font-family: '{{ $family }}';
        }
    </style>
    @if (settingEnabled('blur_login'))
    {{-- If blur login is enabled in settings --}}
        <style type="text/css">
            #login-darken {
                position: absolute;
                background-color: rgba(10, 10, 10, 0.5);
            }
        </style>
    @endif


    @if (config('custom.drift_enabled'))
        @include('partial.drift')
    @endif

    @if (settingEnabled('show_login_image'))
        <style type="text/css">
            .content:before, #login-blur {
                background-image: url("{{ getStorageUrl(config('system.media_dir').'/'.get_option('login_bg')) }}");
            }
        </style>
    @endif


    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js" cache="false">
    </script>
    <script src="js/ie/respond.min.js" cache="false">
    </script>
    <script src="js/ie/excanvas.js" cache="false">
    </script> <![endif]-->
</head>
<body>


<div class="content">

    <section id="content" class="m-t-lg wrapper-md m-t-cust license">

        <div id="login-darken"></div>
        <div id="login-form" class="container aside-xxl animated fadeInUp">


        <span class="navbar-brand block {{ get_option('blur_login') == 'TRUE' ? 'text' : '' }}">
        Workice CRM
      </span>

            <section class="panel panel-default bg-white-cust m-t-lg b-r-cust">
                <header class="panel-heading text-center"><strong>{{ __('Application License') }}</strong></header>

                

                
                {!! Form::open(['route' => 'app.license', 'class' => 'panel-body wrapper-lg ajaxifyForm']) !!}


                <div class="alert alert-danger">
                    @langapp('enter_purchase_code') <a href="https://workice.com">Workice CRM</a>
                  </div>

                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="purchase-code">{{ __('Purchase Code') }}</label>

                            
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            
                </div>


                
            <div class="form-group">
                              
                <button type="submit" class="btn btn-success formSaving btn-block">{{ __('Verify Purchase') }}</button>
                            
            </div>


            <div class="line line-dashed"></div>
            <span class="">Instructions on how to get your purchase code <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">here</a> 
            </span>
                

                


                
        {!! Form::close() !!}
                

                @if (get_option('hide_branding') == 'FALSE') 
                    <footer id="footer copyright-footer">
                        <div class="text-center text-muted padder">
                            <p>
                                <small>Powered by <a href="{{ config('system.saleurl') }}" target="_blank">Workice CRM</a> v{{ getCurrentVersion()['version'] }}
                                    <br>&copy; {{  date('Y')  }} <a href="{{ get_option('company_domain') }}" target="_blank">{{ get_option('company_name') }}</a>
                                </small>
                            </p>
                        </div>
                    </footer>
                @endif

            </section>

        </div>
    </section>
</div>

<script src="{{ getAsset('js/app.js') }}"></script>


<script src="{{ getAsset('plugins/toastr/toastr.min.js') }}"></script>

{!! Toastr::message() !!}

@include('partial.ajaxify')

<script type="text/javascript">
    $(document).ready(function () {
        $(".dropdown-toggle").click(function () {
            $(".dropdown-menu").toggle();
        });
    });
</script>

</body>
</html>
