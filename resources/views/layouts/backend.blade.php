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
    		<!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"> This is some text within a card block. </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. Template designed by <a href="https://colorlib.com">Colorlib</a></footer>
            <!-- End footer -->
    	</div>
    </div>
	<script type="text/javascript" src="{{ asset('js/vendors.js') }}"></script>
	@yield('js')
</body>
</html>