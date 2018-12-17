<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- main theme --}}
    <link rel="stylesheet" href="{{ asset('css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

</head>
<body>
    <div id="main-wrapper">
        @section('auth')
            @yield('content')
        @show
    </div>


    {{-- base core --}}
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- bootstrap js --}}
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- sticky-kit --}}
    <script type="text/javascript" src="{{ asset('js/sticky-kit/sticky-kit.min.js') }}"></script>
    {{-- sidebarmenu --}}
    <script type="text/javascript" src="{{ asset('js/sidebarmenu.js') }}"></script>
    {{-- jquery.slimscroll --}}
    <script type="text/javascript" src="{{ asset('js/jquery.slimscroll.js') }}"></script>
        
    {{-- Js --}}
    <script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>

    @yield('js')
</body>
</html>
