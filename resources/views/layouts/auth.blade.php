<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> @yield('title') | {{ config('app.name')}} </title>
	<!-- app -->
	<link href="{{asset('css/vendors.css')}}" rel="stylesheet" media="all">
	<link href="{{asset('css/custom-frontend.css')}}" rel="stylesheet" media="all">
	@yield('css')
</head>
<body class="bg">
	@yield('content')

	<div class="intro">

						<div class="side side-left">

	                        <div id="ce" class="intro-content">

								<div class="profile">

	                            	<!--<img src="img/logo_ce.png" alt="Ir a Cliente Estrella" title="Ir a Cliente Estrella">-->
	                                <!--<div id="logo-ce" class="svg-container" title="Ir a Cliente Estrella">-->

	                                <div id="ce-logo" class="svg-container">
										<img src="{{ asset('images/bg_left/LittleToes2-Vector.svg') }}" alt="">
	                                </div>
	                                <div id="ce-logo" class="svg-container">
										<img src="{{ asset('images/bg_left/BigToes3-Vector.svg') }}" alt="">
	                                </div>
	                                <div id="ce-logo" class="svg-container">
										<img src="{{ asset('images/bg_left/HappyFeet4-Vector.svg') }}" alt="">
	                                </div>

	                            </div>
							</div>

	                    	<!--<div class="overlay"></div>-->

	                    </div>

						<div class="side side-right">
							<div id="vp" class="intro-content">
								<div class="profile">
	                            	<div class="svg-container">
										<img src="{{ asset('images/bg_right/HappyFeet4_5-Vector.svg') }}" alt="">
	                                </div>
	                            	<div class="svg-container">
										<img src="{{ asset('images/bg_right/HappyFeetAdvanced5_6-Vector.svg') }}" alt="">
	                            	</div>
	                            	<div class="svg-container">
										<img src="{{ asset('images/bg_right/FutureLegends5-7-Vector.svg') }}" alt="">
	                            		
	                            	</div>

	                                <!--<img id="brillo" src="img/brillo.png" >-->
	                            </div>
							</div>
							<!--<div class="overlay"></div>-->
						</div>
					</div>
	<footer class="row footer-site">
    	<div class="container">
    		<a href="">Acceso a Padres</a> | <a href="">Acceso a Coachs</a>
    	</div>
    </footer>
	<script src="{{ asset('js/vendors.js') }}" type="text/javascript"></script>
	@yield('js')
</body>
</html>