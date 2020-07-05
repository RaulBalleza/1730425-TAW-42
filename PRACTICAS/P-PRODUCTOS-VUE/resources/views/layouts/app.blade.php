<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Icons -->
    <link href="{{ asset('vendors/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/css/simple-line-icons.min.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('vendors/css/style.css') }}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    
    <div id="app">
    <navbar-component></navbar-component>
        <div class="app-body">
            <sidebar-component></sidebar-component>
            <main class="main">
                @yield('content')
            </main>
        </div>
    </div>
    <footer-component></footer-component>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('vendors/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/js/pace.min.js') }}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('vendors/js/Chart.min.js') }}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{ asset('vendors/js/template.js') }}"></script>
</body>

</html>