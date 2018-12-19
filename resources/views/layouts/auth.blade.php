<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> @yield('title') | {{ config('app.name')}} </title>
	<!-- app -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
	<link href="{{asset('css/style.css')}}" rel="stylesheet" media="all">
	{{-- <link href="{{asset('css/custom-frontend.css')}}" rel="stylesheet" media="all"> --}}
	@yield('css')
</head>
<body class="bg">
	@yield('content')
	<script src="{{ asset('js/vendors.js') }}" type="text/javascript"></script>
	@yield('js')
</body>
</html>