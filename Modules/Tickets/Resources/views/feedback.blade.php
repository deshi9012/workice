<!DOCTYPE  html>
<html lang="@langapp('lang_code')  " dir="{{ settingEnabled('rtl') ? 'rtl' : 'ltr' }}" >
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="">
        <meta name="author" content="{{ get_option('site_author') }}">
        <meta name="keyword" content="{{ get_option('site_desc') }}">
        
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
        <link rel="apple-touch-icon" sizes="72x72"
            href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
            <link rel="apple-touch-icon" sizes="114x114"
                href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
                <link rel="apple-touch-icon" sizes="144x144"
                    href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
                    @endif
                    <!-- CSRF Token -->
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    
                    <title>{{ get_option('company_name') }}</title>
                    <!-- Bootstrap core CSS -->
                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
                    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
                    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                    
                    <link rel="stylesheet" href="{{ getAsset('css/theme.css') }}" type="text/css"/>
                    <link rel="stylesheet" href="{{ getAsset('css/app.css') }}" type="text/css"/>
                    <link rel="stylesheet" href="{{ getAsset('plugins/apps/pace.css') }}" type="text/css"/>
                    <link rel="stylesheet" href="{{ getAsset('storage/css/style.css') }}" type="text/css"/>
                    <link rel="stylesheet" href="{{ getAsset('css/sofia.css') }}" type="text/css"/>
                    <?php
                    $family = 'Sofia';
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
                    body { font-family: '{{ $family }}'; padding: 50px; }
                    </style>
                    <!--[if lt IE 9]>
                    <script src="js/ie/html5shiv.js">
                    </script>
                    <script src="js/ie/respond.min.js">
                    </script>
                    <script src="js/ie/excanvas.js">
                    </script> <![endif]-->
                </head>
                <body class="bg">
                    <div class="vbox text-center">
                        <section class="container-fluid">
                            <section id="content">
                                <div class="wrapper rating scrollable">
                                    <a href="{{ route('tickets.index') }}" class="btn btn-info btn-sm">
                                    @icon('solid/home') {{ get_option('company_nema') }}</a>
                                    <h3>@langapp('feedback_for_ticket', ['subject' => $ticket->subject])</h3>
                                    {!! Form::open(['url' => URL::signedRoute('tickets.rating', $ticket->id), 'class' => 'ajaxifyForm']) !!}
                                    @langapp('how_would_you_rate_support')
                                    <div class="form-radio">
                                        <label class="">
                                            <input type="radio" name="rating" value="1" checked>
                                            <span class="label-text text-success">@icon('solid/thumbs-up') @langapp('satisfied')</span>
                                        </label>
                                    </div>
                                    <div class="form-radio">
                                        <label class="">
                                            <input type="radio" name="rating" value="0">
                                            <span class="label-text text-danger">@icon('solid/thumbs-down') @langapp('unsatisfied')</span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>@langapp('feedback_comment')</label>
                                        <textarea name="message" class="form-control markdownEditor"></textarea>
                                    </div>
                                    {!!  renderAjaxButton('send')  !!}
                                    {!! Form::close() !!}
                                </div>
                            </section>
                        </section>
                    </div>
                    
                    @push('pagescript')
                    @include('stacks.js.markdown')
                    @include('partial.ajaxify')
                    @endpush
                    <script src="{{ getAsset('js/app.js') }}"></script>
                    <script src="{{ getAsset('js/theme.js') }}"></script>
                    @stack('pagescript')
                    
                </body>
            </html>