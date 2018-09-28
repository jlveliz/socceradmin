@extends('layouts.auth')

@section('title','Registro')

@section('js')
<script src="{{ asset('js/register.js') }}" type="text/javascript"></script>
@endsection

@section('content')

 <!-- Main wrapper  -->
    <div id="main-wrapper" class="register-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                                <form class="needs-validation @if($errors->has('num_identification')) was-validated @endif" action="{{ route('register-verify') }}" method="post" novalidate>
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 form-group">
                                            <label for="num_identification">Cédula del Representante</label>
                                            <input id="num_identification" name="num_identification" type="text" class="form-control" autofocus autocomplete="false" required pattern="[0-9]+" minlength="10" maxlength="10" value="{{ old('num_identification')}}" @if($errors->has('num_identification')) style="border-color: " @endif>
                                            <div class="invalid-feedback">Ingrese una cédula.</div>
                                            @if($errors->has('num_identification'))
                                                <div class="invalid-feedback" style="display: block">
                                                    {{$errors->first('num_identification')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                                	{{-- <div class="row">
	                                    <div class="col-sm-6 col-lg-6 form-group">
	                                        <label for="num_identification">Cédula del Representante</label>
	                                        <input id="num_identification" name="num_identification" type="text" class="form-control" placeholder="0925844546" autofocus="" autocomplete="false">
	                                    </div>
	                                    <div class="col-sm-6 col-lg-6 form-group">
	                                        <label for="representant_name">Nombre de Representante</label>
	                                        <input id="representant_name" name="representant_name" type="text" class="form-control" placeholder="Nombre Apellido">
	                                    </div>
                                	</div>
                                	<div class="row">
	                                    <div class="col-sm-6 col-lg-6 form-group">
	                                        <label for="num_mobile">Número Móvil</label>
	                                        <input type="text" class="form-control" placeholder="0996781025" pattern="">
	                                    </div>
	                                    <div class="col-sm-6 col-lg-6 form-group">
	                                    	<label for="email">Correo Electrónico</label>
	                                    	<input type="email" class="form-control" placeholder="correo@dominio.com">
	                                    </div>
                                	</div>

                                	<div class="row">
                                		<div class="col-sm-6 col-lg-6 form-group">
	                                        <label for="neighborhood">Barrio Donde vives</label>
	                                        <input type="text" id="neighborhood" name="neighborhood" class="form-control" placeholder="Guangala">
	                                    </div>
	                                    <div class="col-sm-6 col-lg-6 form-group">
	                                    	<label for="num_childrens">Numero de Hijos</label>
	                                    	<select name="num_childrens" id="num_childrens" class="form-control">
	                                    		<option value="null">--Seleccione--</option>
	                                    		@for ($i = 1; $i <= 4 ; $i++)
	                                    			<option value="{{$i}}">{{$i}}</option>
	                                    		@endfor
	                                    	</select>
	                                    </div>
                                	</div>

                                	<div class="row">
                                			
                                	</div>

                                    <div class="checkbox">
                                        <label>
										<input type="checkbox"> Acepto los terminos y condiciones
									</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Registrarse</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="row footer-site">
        	<div class="container">
        		<a href="">Acceso a Padres</a> | <a href="">Acceso a Coachs</a>
        	</div>
        </footer>

    </div>

@endsection