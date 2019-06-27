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


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Workice CRM') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="author" content="{{ get_option('site_author') }}">
    <meta name="keywords" content="{{ get_option('site_keywords') }}">
    <meta name="description" content="{{ get_option('site_desc') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" href="{{ getAsset('css/theme.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ getAsset('plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ getAsset('css/login.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ getAsset('storage/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ getAsset('css/lato.css') }}" type="text/css"/>

    @if (config('system.enable_tawk'))
        @include('partial.tawk')
    @endif


    <?php
    $family = 'Default';
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
        case 'miriam':
            $family = 'Miriam Libre';
            echo "<link href='//fonts.googleapis.com/css?family=Miriam+Libre' rel='stylesheet'>";
            break;
    }
    ?>
    <style type="text/css">
        body {
            font-family: '{{ $family }}';
        }
    </style>
    @if (settingEnabled('blur_login'))
    {{-- blur login if enabled --}}
        <style type="text/css">
            #login-darken {
                background-color: rgba(10, 10, 10, 0.5);
            }
        </style>
    @endif


    @if (config('system.drift_enabled'))
        @include('partial.drift')
    @endif
    @if (config('system.crisp_enabled'))
        @include('partial.crisp')
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
<div id="app">

{{-- main content start --}}
@yield('content')
{{-- main content end --}}
<script src="{{ getAsset('js/app.js') }}"></script>

@if(settingEnabled('use_recaptcha'))
{!! NoCaptcha::renderJs(getLocaleUsingLanguage(get_option('default_language'))) !!}
@endif

{!! Toastr::message() !!}

@include('partial.ajaxify')

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-rel="tooltip"]').tooltip();
        $(".dropdown-toggle").click(function () {
            $(".dropdown-menu").toggle();
        });
    });
</script>
</div>
</body>
</html>
