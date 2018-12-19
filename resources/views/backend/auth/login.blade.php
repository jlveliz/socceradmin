@extends('layouts.auth')

@section('title','Administración')

@section('content')
<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
		<div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
            <div class="login-form">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                <h3 class="text-center">Ingreso Administrativo</h3>
                
                <form class="needs-validation form-valide" action="{{ route('backend-login') }}" method="post" id="admin-login">
                	{{ csrf_field() }}
                	<div class="form-group">
                		<label>Usuario</label>
                		<input type="text" class="form-control" id="val-username" placeholder="Usuario" name="username" autofocus="" required="">
                	</div>
                	<div class="form-group">
                		<label>Contraseña</label>
                		<input type="password" class="form-control" id="val-password" placeholder="Contraseña" name="password" required="">
                	</div>
                	<div class="checkbox">
                		<label>
                			<input type="checkbox" name="remember"> Recordarme
                		</label>
                	</div>
                	<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Ingresar</button>
                </form>
            </div>
        </div>
    </div> 	
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/validations.js') }}"></script>
@endsection
