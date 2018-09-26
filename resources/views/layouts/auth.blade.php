<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title') | {{ config('app.name')}} </title>
	<!-- app -->
	<link href="{{asset('css/app.css')}}" rel="stylesheet" media="all">
</head>
<body class="fix-header fix-sidebar">
	@yield('content')
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>