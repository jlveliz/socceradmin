<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
    
    <title> @yield('title') - {{ config('app.name')}}</title>
</head>
<body class="fix-header fix-sidebar">
	<!-- Preloader - style you can find in spinners.css -->
    {{-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> --}}

     <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- Header -->
        @section('header')
           @include('partials.top-back')
        @show
        <!-- .Header -->
        
        
        <!-- Sidebar -->
        @section('sidebar')
            @include('partials.left-back')
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
                        <li class="breadcrumb-item"><a href="@yield('route-parent')">@yield('parent-page')</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
             <!-- Container fluid  -->
            <div class="container-fluid">
                @yield('content')
            </div>

            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © {{ date('Y') }} Todos los derechos reservados <a href="https://thejlmedia.com" target="_blank">thejlmedia</a></footer>
            <!-- End footer -->
    	</div>
    </div>


    @include('partials.modals-delete')
    @include('partials.modals-search')
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
    @yield('js')
</body>
</html>