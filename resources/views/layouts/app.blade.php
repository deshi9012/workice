<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ get_option('rtl') == 'TRUE' ? 'rtl' : 'ltr' }}" class="app">
<head>

	<meta charset="utf-8"/>
	<meta name="author" content="{{ get_option('site_author') }}">
	<meta name="keywords" content="{{ get_option('site_keywords') }}">
	<meta name="description" content="{{ get_option('site_desc') }}">

    <?php $favicon = get_option('site_favicon');
    $ext = substr($favicon, -4); ?>
	@if ($ext == '.ico')
		<link rel="shortcut icon" href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
	@endif
	@if ($ext == '.png')
		<link rel="icon" type="image/png"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
	@endif
	@if ($ext == '.jpg' || $ext == 'jpeg')
		<link rel="icon" type="image/jpeg"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon')) }}">
	@endif
	@if (get_option('site_appleicon') != '')
		<link rel="apple-touch-icon"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
		<link rel="apple-touch-icon" sizes="72x72"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
		<link rel="apple-touch-icon" sizes="114x114"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
		<link rel="apple-touch-icon" sizes="144x144"
			  href="{{ getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon')) }}"/>
	@endif

	<meta name="userId" content="{{ Auth::check() ? Auth::id() : '' }}">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ count(Auth::user()->unreadNotifications) > 0 ? '('.count(Auth::user()->unreadNotifications).')' : '' }} {{ get_option('company_name') }}
		- {{ $page }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="stylesheet" href="{{ getAsset('css/theme.css') }}" type="text/css"/>

	<link rel="stylesheet" href="{{ getAsset('plugins/apps/pace.css') }}" type="text/css"/>

	@if(config('system.material_design'))
		<link rel="stylesheet" href="{{ getAsset('css/propeller.min.css') }}" type="text/css"/>
	@endif
	@isset($sign)
		<link href="//fonts.googleapis.com/css?family=Mr+Dafoe" rel="stylesheet">
	@endisset
	@isset($help)
		<link rel="stylesheet" href="{{ getAsset('plugins/intro/introjs.min.css')  }}" type="text/css"/>
	@endisset
	@isset($signature)
		<link href="//fonts.googleapis.com/css?family=Dawning+of+a+New+Day" rel="stylesheet">
	@endisset
	@if (config('system.drift_enabled'))
		@include('partial.drift')
	@endif
	@if (config('system.crisp_enabled'))
		@include('partial.crisp')
	@endif
	@if (config('system.enable_onesignal'))
		@include('partial.onesignal')
	@endif

	@if (config('system.enable_tawk'))
		@include('partial.tawk')
	@endif


	@stack('pagestyle')

	<link rel="stylesheet" href="{{ getAsset('css/app.css') }}" type="text/css"/>

	<link rel="stylesheet" href="{{ getAsset('storage/css/style.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ getAsset('css/lato.css') }}" type="text/css"/>

	@include('partial.custom')

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

		h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
			font-family: '{{ $family }}', sans-serif;
		}

		.inv-bg {
			background-color: {{ get_option('invoice_color') }};
		}

		.est-bg {
			background-color: {{ get_option('estimate_color') }};
			color: #fff;
		}
	</style>


	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
@include('cookie_consent')

<section class="vbox" id="app">


	@include('partial.top_header')

	<section class="">
		<section class="hbox stretch">


			@include('partial.main_menu')


			@yield('content')


			@include('partial.notifier')


		</section>
	</section>
</section>


<script src="{{ getAsset('js/app.js') }}"></script>
@stack('custom-pagescript')

<script src="{{ getAsset('js/theme.js') }}"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script>
	var locale = '@langapp('
	lang_code
	') ';
	var base_url = '{{ url('/') }}';

	axios.defaults.headers.common['Content-Language'] = '{{ app()->getLocale() }}';
</script>

@if (config('system.pusher_enabled'))
	@include('partial.pusher')
@endif


@if(config('system.material_design'))
	<script type="text/javascript" src="{{ getAsset('js/propeller.min.js') }}"></script>
@endif


<script src="{{ getAsset('js/plugins.js') }}"></script>

@isset($help)
	<script src="{{ getAsset('plugins/intro/intro.min.js') }}"></script>
	<script src="{{ getAsset('plugins/intro/demo.js') }}"></script>
@endisset

{!! Toastr::message() !!}

@stack('pagescript')

@include('partial.ajaxify')

<script>
	$(document).ready(function () {
		$(".comment-item table").addClass("table table-striped");

		$('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});

		if ($('.nav-w-children li').hasClass('active')) {
			var el = $('.nav-w-children').attr('id');
			$('#' + el).addClass("active");
		}

		toastr.options.positionClass = '{{ config('toastr.options.positionClass') }}';
		$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
		$.fn.modal.prototype.constructor.Constructor.DEFAULTS.keyboard = false;
		$.fn.modal.Constructor.prototype.enforceFocus = function () {
		};

		$('.clickable tr').click(function () {
			var href = $(this).find("a").attr("href");
			if (href) {
				window.location = href;
			}
		});
		$('#clear-alerts').click(function () {
			axios.get('{{ route('users.notifications.clear') }}').then(function (response) {
				toastr.success('Notifications cleared successfully', '@langapp('
				response_status
				') '
			)
				;
			})
				.catch(function (error) {
					toastr.error('Error clearing notifications', '@langapp('
					response_status
					') '
				)
					;
				});
		});
	});
</script>


</body>
</html>