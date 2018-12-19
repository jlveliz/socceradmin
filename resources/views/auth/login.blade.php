@extends('layouts.auth')

@section('title','Ingreso')

@section('content')
<div class="unix-login">
   
<section class="login-block">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-12 login-sec">
            <h2 class="text-center">Ingreso</h2>
            <form class="login-form" action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
                    <label for="email" class="text-uppercase">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="" name="email" value="{{ old('email') }}" autofocus="">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback animated fadeInDown">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
                    <label for="password" class="text-uppercase">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback animated fadeInDown">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <small>Recordarme</small>
                    </label>
                    <button type="submit" class="btn btn-login float-right">
                        <span class="signingin hidden"><span class="voyager-refresh"></span> Ingresando...</span>
                        <span class="signin">Ingresar</span>
                    </button>
              </div>
          </form>


          <div class="copy-text">Creado Por <i class="fa fa-heart"></i>  <a href="https://thejlmedia.com">thjlmedia.com</a>
          </div>
        </div>
        <div class="col-md-8 d-none d-sm-block banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block img-fluid" src="{{ asset('images/bg_1.jpg') }}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                        <h2>Happy Feet Sur</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
                    </div>
                </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{ asset('images/bg_2.jpg') }}" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                <div class="banner-text">
                    <h2>Happy Feet Sur</h2>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
                </div>  
                </div>
            </div>
          </div>
      </div>
  </div>
    </div>
</div>
</section>
</div>
@endsection

@section('js')
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    var email = document.querySelector('[name="email"]');
    var password = document.querySelector('[name="password"]');
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
</script>
@endsection
