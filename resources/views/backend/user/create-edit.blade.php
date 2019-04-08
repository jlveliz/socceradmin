@extends('layouts.backend')
@section('title', isset($user) ?  'Editar Usuario '. $user->name : 'Crear Usuario' )
@section('parent-page','Usuarios')
@section('route-parent',route('users.index') )
@section('current-page',isset($user) ?  'Editar Usuario '. $user->name : 'Crear Usuario' )


@section('content')

<ul class="nav nav-tabs customtab mb-2">
    <li class="nav-item">
        <a class="nav-link active" id="field-tab" data-toggle="tab" href="#users" role="tab" aria-controls="user" aria-selected="true">Usuarios</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" id="roles-tab"  href="{{route('roles.index')}}">Roles</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="permissions-tab"  href="{{route('permissions.index')}}">Permisos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="permissionstype-tab"  href="{{route('permission-types.index')}}">Tipos de Permisos</a>
    </li>
</ul>

<!-- Container fluid  -->
<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
        <div class="card p-30">
    		<div class="card-body col-12">
    			@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-card alert-{{ session()->get('type') }} with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
    			@endif
				
				{{-- validation errors --}}
				{{-- @if($errors->any())
					<div class="alert-card alert-danger alert  with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			@foreach ($errors->all() as $error)
							{{$error}} <br>
						@endforeach
					</div>
				@endif --}}

    			<div class="form-validation">
	            	<form action="@if(isset($user)) {{ route('users.update',['id'=>$user->id]) }} @else {{ route('users.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($user))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $user->id }}">
	            		@endif
	                	<div class="row">
	                		<div class="col-lg-3 col-12">
		                		<div class="form-group">
		                			<label for="username">Usuario <span class="text-danger">*</span></label>
		                			<input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($user)){{ $user->username }}@else{{ old('username') }}@endif">
		                			@if ($errors->has('username'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('username') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-12">
		                		<div class="form-group">
		                			<label for="email">Email <span class="text-danger">*</span></label>
		                			<input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif">
		                			@if ($errors->has('email'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('email') }}</div>
		                			@endif
		                		</div>
							</div>
							<div class="col-lg-3 col-12">
									<div class="form-group">
										<label for="num_identification">Num Identificación</label>
										<input type="text" name="num_identification" id="num_identification" class="form-control {{ $errors->has('num_identification') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->num_identification }}@else{{ old('num_identification') }}@endif">
										@if ($errors->has('num_identification'))
											<div class="invalid-feedback animated fadeInDown">{{ $errors->first('num_identification') }}</div>
										@endif
									</div>
								</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->name }}@else{{ old('name') }}@endif" >
		                			@if ($errors->has('name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="lastname">Apellido <span class="text-danger">*</span></label>
		                			<input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->last_name }}@else{{ old('last_name') }}@endif" >
		                			@if ($errors->has('last_name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('last_name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="password">Contraseña <span class="text-danger">*</span></label>
		                			<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  value="" >
		                			@if ($errors->has('password'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('password') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="rep_password">Rep. Contraseña <span class="text-danger">*</span></label>
		                			<input type="password" name="rep_password" id="rep_password" class="form-control {{ $errors->has('rep_password') ? ' is-invalid' : '' }}"  value="">
		                			@if ($errors->has('rep_password'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('rep_password') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group  {{ $errors->has('mobile') ? ' is-invalid' : '' }}">
		                			<label for="mobile">Celular </label>
		                			<input type="text" name="mobile" id="mobile" class="form-control"  value="@if(isset($user)){{ $user->person->mobile }}@else{{ old('mobile') }}@endif"  >
		                			@if ($errors->has('mobile'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('mobile') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group  {{ $errors->has('state') ? ' is-invalid' : '' }}">
		                			<label for="state">Estado </label>
		                			<select name="state" id="state" class="form-control">
		                				<option value="1" @if( (isset($user) && $user->state == 1 ) ||  old('state') == '1' )  selected  @endif>Activo</option>
		                				<option value="0"  @if( (isset($user) && $user->state == 0 ) ||  old('state') == '0' )  selected  @endif>Inactivo</option>
		                			</select>
		                			@if ($errors->has('state'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group">
		                			<label for="phone">Teléfono </label>
		                			<input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->phone }}@else{{ old('phone') }}@endif">
		                			@if ($errors->has('phone'))
		                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('phone') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group">
		                			<label for="genre">Género </label>
		                			<select type="text" name="genre" id="genre" class="form-control {{ $errors->has('genre') ? ' is-invalid' : '' }}">
		                				<option value="m" @if( (isset($user) && $user->person->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
		                				<option value="f" @if( (isset($user) && $user->person->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
		                			</select>
		                			@if ($errors->has('genre'))
		                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('genre') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-6 col-12">
		                		<div class="form-group">
		                			<label for="address">Dirección </label>
		                			<input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->address }}@else{{ old('address') }}@endif">
		                			@if ($errors->has('address'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('address') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
	                			<div class="form-group">
		                			<label for="facebook_link">Link de Facebook </label>
		                			<input type="text" name="facebook_link" id="facebook_link" class="form-control {{ $errors->has('facebook_link') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->facebook_link }}@else{{ old('facebook_link') }}@endif" >
		                			@if ($errors->has('facebook_link'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('facebook_link') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-6 col-6">
	                			<div class="form-group">
		                			<label for="activity">Actividad</label>
		                			<input type="text" name="activity" id="activity" class="form-control {{ $errors->has('activity') ? ' is-invalid' : '' }}"  value="@if(isset($user)){{ $user->person->activity }}@else{{ old('activity') }}@endif" >
		                			@if ($errors->has('activity'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('activity') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
	                			<div class="form-group form-check">
		                			<input type="checkbox" name="super_admin" id="super_admin" class="form-check-input {{ $errors->has('super_admin') ? ' is-invalid' : '' }}"  value="1" @if(isset($user) && $user->super_admin == 1) checked @endif>
		                			<label for="super_admin" class="form-check-label">Es Administrador?</label>
		                			@if ($errors->has('super_admin'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('super_admin') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                	</div>
	                	<div class="row">
	                		<div class="col-12 mb-4">
	                			<h4>Roles</h4>
		                		@if ($errors->has('roles'))
		                			<div class="form-group form-control is-invalid">
				                			<div class="invalid-feedback animated fadeInDown" style="display: block">{{ $errors->first('roles') }}</div>
		                			</div>
			                	@endif
	                			<hr>
	                				<div class="row">
				                		@foreach ($roles as $index => $role)
			                			<ul class="list-unstyled col-lg-4 col-6">
		                					<li>
		                						<div class="form-check">
		                						  <input class="form-check-input" type="checkbox" value="{{$role->id}}" id="role_{{$role->id}}" name="roles[]" @if(isset($user)&& $user->hasRole($role->id)) checked="" @endif>
		                						  <label class="form-check-label" for="role_{{$role->id}}">
		                						    {{$role->name}} <br><small>@if($role->description)({{$role->description}})@endif</small>
		                						  </label>
		                						</div>
		                					</li>
			                			</ul>
				                		@endforeach
	                				</div>
	                		</div>
	                		
	                		
	                	</div>
    			</div>
    		</div>
    		<div class="card-footer col-12">
		    	<div class="form-actions">
		    		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
		    		<button class="btn btn-primary " type="submit"><i class="i-Data-Save"></i> Guardar</button>
		    		<button class="btn btn-secondary  save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
		    		<a class="btn btn-dark" href="{{ route('users.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection
