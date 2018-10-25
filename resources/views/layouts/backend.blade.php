<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield('title') | {{ config('app.name')}}</title>
	<link rel="stylesheet" href="{{ asset('css/vendors.css') }}">
	@yield('css')
</head>
<body class="fix-header fix-sidebar">
	<!-- Preloader - style you can find in spinners.css -->
    {{-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> --}}

     <!-- Main wrapper  -->
    <div id="main-wrapper">
    	@include('partials.top-back')

    	@include('partials.left-back')

    	<div class="page-wrapper">
			
			@yield('content')

            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © {{ date('Y') }} Todos los derechos reservados.</footer>
            <!-- End footer -->
    	</div>
    </div>
	<script type="text/javascript" src="{{ asset('js/vendors.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
	@yield('js')
</body>
</html>