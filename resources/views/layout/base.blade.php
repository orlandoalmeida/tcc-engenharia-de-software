<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }} - {{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="{{ env('APP_NAME') }}" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome/css/font-awesome.min.css') }}" />
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/lobibox-master/dist/css/lobibox.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style-custom.css') }}" rel="stylesheet" type="text/css" />
    @hasSection('app-css')
        @yield('app-css')
    @endif
</head>
<body>
    @include('layout.top-menu')
    @include('layout.side-menu')
    <div id="layout-wrapper">
        <div class="main-content">
            @hasSection('content')
                @yield('content')
            @endif
            @include('layout.footer')
        </div>
    </div>
    <div class="menu-overlay"></div>
    <script>var baseUri = '{{url('')}}'; </script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('assets/plugins/lobibox-master/dist/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="{{ asset('js/validations.js') }}"></script>
    <script src="{{ asset('assets/datatable_ptbr.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    @hasSection('app-js')
        @yield('app-js')
    @endif
</body>
</html>
