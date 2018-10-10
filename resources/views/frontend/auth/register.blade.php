@extends('layouts.auth')

@section('title','Registro')

@section('js')
<script src="{{ asset('js/register.js') }}" type="text/javascript"></script>
@endsection

@section('content')


    <p>
@php
print_r(session()->all());
@endphp
</p>
{{-- ============= REPRESENTANTES ============== --}}

{{-- INGRESA NOMBRES REPR --}}
@if (!session()->has('register_wizard.representant_exist_name'))
    <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                        <div class="login-form">
                            <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                            <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                            <form class="needs-validation @if($errors->has('representant_name') || $errors->has('representant_last_name')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                                {{ csrf_field() }}
                                <input type="hidden" name="is_representant_name" value="1">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                        <label for="representant_name">Nombres del Representante</label>
                                        <input id="representant_name" name="representant_name" type="text" class="form-control" autofocus autocomplete="false" required pattern="[a-Z,A-Z]+" minlength="5" value="{{ old('representant_name')}}" @if($errors->has('representant_name')) style="border-color: #dc3545" @endif>
                                        <div class="invalid-feedback">Ingrese un nombre.</div>
                                        @if($errors->has('representant_name'))
                                            <div class="invalid-feedback" style="display: block">
                                                {{$errors->first('representant_name')}}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                        <label for="representant_last_name">Apellidos del Representante</label>
                                        <input id="representant_last_name" name="representant_last_name" type="text" class="form-control" required pattern="[a-Z,A-Z]+" minlength="5" value="{{ old('representant_last_name')}}" @if($errors->has('representant_last_name')) style="border-color: #dc3545" @endif>
                                        <div class="invalid-feedback">Ingrese un apellido.</div>
                                        @if($errors->has('representant_last_name'))
                                            <div class="invalid-feedback" style="display: block">
                                                {{$errors->first('representant_last_name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                            </form>
                        </div>
                    
                </div>
            </div>
    </div>
@endif

{{-- INGRESA NUMERO DE TELEFONO --}}
@if (!session()->has('register_wizard.representant_exist_phone') && (session()->get('register_wizard.representant_exist_name') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('is_representant_phone')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_representant_phone" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="representant_phone">Número de Teléfono</label>
                                <input id="representant_phone" name="representant_phone" type="text" class="form-control" autofocus required pattern="[0-9]+" minlength="7" minlength="10" value="{{ old('representant_phone')}}" @if($errors->has('representant_phone')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un Teléfono.</div>
                                @if($errors->has('representant_phone'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('representant_phone')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- INGRESA NUMERO DE MOVIL --}}
@if (!session()->has('register_wizard.representant_exist_mobile') && (session()->get('register_wizard.representant_exist_phone') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('representant_mobile')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_representant_mobile" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="representant_mobile">Número de Celular</label>
                                <input id="representant_mobile" name="representant_mobile" type="text" class="form-control" autofocus required pattern="[0-9]+" minlength="7" minlength="10" value="{{ old('representant_mobile')}}" @if($errors->has('representant_mobile')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un Número de Celular.</div>
                                @if($errors->has('representant_mobile'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('representant_mobile')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- INGRESA CORREO ELECTRONICO --}}
@if (!session()->has('register_wizard.representant_exist_email') && (session()->get('register_wizard.representant_exist_mobile') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('representant_email')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_representant_email" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="representant_email">Correo Electrónico</label>
                                <input id="representant_email" name="representant_email" type="email" class="form-control" autofocus required minlength="5" value="{{ old('representant_email')}}" @if($errors->has('representant_email')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un Correo Electrónico.</div>
                                @if($errors->has('representant_email'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('representant_email')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- INGRESA DIRECCION --}}
@if (!session()->has('register_wizard.representant_exist_address') && (session()->get('register_wizard.representant_exist_email') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('representant_address')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_representant_address" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="representant_address">Dirección, Barrio/Sector</label>
                                <input id="representant_address" name="representant_address" type="text" class="form-control" autofocus required minlength="5" value="{{ old('representant_address')}}" @if($errors->has('representant_address')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese una dirección.</div>
                                @if($errors->has('representant_address'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('representant_address')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- ============= HIJOS ============== --}}

{{-- INGRESA NOMBRE --}}
@if (!session()->has('register_wizard.children_exist_name') && (session()->get('register_wizard.representant_exist_address') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('children_name')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_children_name" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="children_name">Primer Nombre del Niño(a)</label>
                                <input id="children_name" name="children_name" type="text" class="form-control" autofocus required minlength="5" value="{{ old('children_name')}}" @if($errors->has('children_name')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un nombre del niño(a).</div>
                                @if($errors->has('representant_address'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('representant_address')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

{{-- INGRESA APELLIDO --}}
@if (!session()->has('register_wizard.children_exist_last_name') && (session()->get('register_wizard.children_exist_name') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('children_last_name')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_children_last_name" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="children_last_name">Primer Apellido del Niño(a)</label>
                                <input id="children_last_name" name="children_last_name" type="text" class="form-control" autofocus required minlength="5" value="{{ old('children_last_name')}}" @if($errors->has('children_last_name')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un apellido del niño(a).</div>
                                @if($errors->has('representant_address'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('children_last_name')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- INGRESA DOMINITUVI --}}
@if (!session()->has('register_wizard.children_exist_nickname') && (session()->get('register_wizard.children_exist_last_name') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('children_nickname')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_children_nickname" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="children_nickname">¿Cuál es el nombre diminutivo de tu hijo?</label>
                                <input id="children_nickname" name="children_nickname" type="text" class="form-control" autofocus required minlength="5" value="{{ old('children_nickname')}}" @if($errors->has('children_nickname')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un nickaname del niño(a).</div>
                                @if($errors->has('children_nickname'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('children_nickname')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

{{-- INGRESA ANTECEDENTE MEDICO --}}
@if (!session()->has('register_wizard.children_exist_medical_history') && (session()->get('register_wizard.children_exist_nickname') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation @if($errors->has('children_medical_history')) was-validated @endif" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_children_medical_history" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="children_medical_history">¿El niño(a) tiene algún antecedente médico?</label>
                                <input id="children_medical_history" name="children_medical_history" type="text" class="form-control" autofocus required minlength="2" value="{{ old('children_medical_history')}}" @if($errors->has('children_medical_history')) style="border-color: #dc3545" @endif>
                                <div class="invalid-feedback">Ingrese un antecedente médico del niño(a).</div>
                                @if($errors->has('children_medical_history'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('children_medical_history')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif


{{-- INGRESA USUARIO/ENLACE FB --}}
@if (!session()->has('register_wizard.representant_exist_facebook_link') && (session()->get('register_wizard.children_exist_medical_history') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_representant_facebook_link" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="representant_facebook_link">Enlace/Usuario de Facebook del Representante</label>
                                <input id="representant_facebook_link" name="representant_facebook_link" type="text" class="form-control" autofocus value="{{ old('representant_facebook_link')}}" @if($errors->has('representant_facebook_link')) style="border-color: #dc3545" @endif>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

{{-- INGRESA TIPO DE CLASE --}}
@if (!session()->has('register_wizard.group_class_exist_group') && (session()->get('register_wizard.representant_exist_facebook_link') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_group_children_class_type" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="group_class_type">Seleccione un tipo de Clase</label>
                                <select name="group_class_type" id="group_class_type" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="trial" @if(old('group_class_type') == 'trial') selected @endif>Demostrativa</option> 
                                    <option value="regular" @if( old('group_class_type') == 'regular') selected @endif>Clases Regulares</option> 
                                </select>
                                <div class="invalid-feedback">Seleccione un tipo de clase.</div>
                                @if($errors->has('group_class_type'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('group_class_type')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

{{-- INGRESA UNA EDAD DEL NIñO --}}
@if (!session()->has('register_wizard.children_exist_age') && (session()->get('register_wizard.group_class_exist_group') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_children_age" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="children_age">Seleccione una Edad del niño(a)</label>
                                <select name="children_age" id="children_age" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @for ($i = 2; $i <= 8 ; $i++)
                                        <option value="trial" @if(old('children_age') == $i) selected @endif>{{$i}} Años</option> 
                                    @endfor
                                </select>
                                <div class="invalid-feedback">Seleccione una edad del niño(a).</div>
                                @if($errors->has('group_class_type'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('children_age')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Siguiente</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

{{-- INGRESA UNA EDAD DEL NIñO --}}
@if (!session()->has('register_wizard.children_exist_date_for_class') && (session()->get('register_wizard.children_exist_age') == 1))
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 col-sm-12 card">
                <div class="login-form">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid mx-auto d-block" alt="{{config('app.name')}}" title="{{config('app.name')}}">
                    <h3 class="text-center">Registro para Inicio de Clases Regulares y Demostrativas</h3>

                    <form class="needs-validation" action="{{ route('register-wizard') }}" method="post" novalidate>
                        {{ csrf_field() }}
                        <input type="hidden" name="is_date_for_class" value="1">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-xs-12 form-group">
                                <label for="group_class_date">Seleccione un día para la Clase</label>
                                <input  class="form-control" name="group_class_date" id="group_class_date" required>
                                <div class="invalid-feedback">Seleccione una fecha para la clase.</div>
                                @if($errors->has('group_class_date'))
                                    <div class="invalid-feedback" style="display: block">
                                        {{$errors->first('group_class_date')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Registrarse</button>
                    </form>
                </div>
            
        </div>
    </div>
</div>
@endif

@endsection