<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ get_option('rtl') == 'TRUE' ? 'rtl' : 'ltr' }}" class="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Workice Installer</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_favicon.png') }}">
        <link href="{{ getAsset('css/theme.css') }}" rel="stylesheet"/>
        <link href="{{ getAsset('css/login.css') }}" rel="stylesheet"/>
        <link href="{{ getAsset('plugins/fuelux/fuelux.min.css') }}" rel="stylesheet"/>
        @yield('style')
        <script>
        window.Laravel = <?php echo json_encode(
            [
            'csrfToken' => csrf_token(),
            ]
        ); ?>
        </script>
    </head>
    <body>
        
        @yield('content')
        <script src="{{ getAsset('js/app.js') }}"></script>
        <script src="{{ getAsset('js/theme.js') }}"></script>
        @yield('scripts')
        
    </body>
</html>