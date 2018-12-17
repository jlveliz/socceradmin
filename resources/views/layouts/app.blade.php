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
<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        <!-- Header -->
        @section('header')
            @include('partials.header')
        @show
        <!-- .Header -->
        
        <!-- Sidebar -->
        @section('sidebar')
            @include('partials.sidebar')
        @show
        <!-- .Sidebar -->

        
        <!-- Content -->
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">@yield('title')</h3>                    
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">@yield('parent-page')</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>

             <!-- Container fluid  -->
            <div class="container-fluid">
                @yield('content')
            </div>

            <!-- footer -->
            <footer class="footer"> © {{ date('Y') }} Todos los derechos reservados <a href="https://thejlmedia.com">thejlmedia</a></footer>
            <!-- End footer -->
        </div>
        <!-- .Content -->


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
