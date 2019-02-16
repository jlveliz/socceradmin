@extends('layouts.backend')
@section('title', isset($user) ?  'Editar Usuario '. $user->name : 'Crear Usuario' )
@section('parent-page','Usuarios')
@section('route-parent',route('users.index') )

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">
            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($user)) {{  'Editar Usuario '. $user->name }} @else Crear Usuario @endif </h3>
            		</div>

            		<div class="card-body col-12">
            			@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
            			@endif
            			<div class="form-validation">
			            	<form action="@if(isset($user)) {{ route('users.update',['id'=>$user->id]) }} @else {{ route('users.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($user))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $user->id }}">
			            		@endif
			                	<div class="row">
			                		<div class="col-lg-3 col-12">
				                		<div class="form-group {{ $errors->has('username') ? ' is-invalid' : '' }}">
				                			<label for="username">Usuario <span class="text-danger">*</span></label>
				                			<input type="text" name="username" id="username" class="form-control"  autofocus="" value="@if(isset($user)){{ $user->username }}@else{{ old('username') }}@endif">
				                			@if ($errors->has('username'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('username') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-12">
				                		<div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
				                			<label for="email">Email <span class="text-danger">*</span></label>
				                			<input type="email" name="email" id="email" class="form-control"  value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif">
				                			@if ($errors->has('email'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('email') }}</div>
				                			@endif
				                		</div>
									</div>
									<div class="col-lg-3 col-12">
											<div class="form-group {{ $errors->has('num_identification') ? ' is-invalid' : '' }}">
												<label for="num_identification">Num Identificación <span class="text-danger">*</span></label>
												<input type="text" name="num_identification" id="num_identification" class="form-control"  autofocus="" value="@if(isset($user)){{ $user->person->num_identification }}@else{{ old('num_identification') }}@endif">
												@if ($errors->has('num_identification'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('num_identification') }}</div>
												@endif
											</div>
										</div>
			                		<div class="col-lg-3 col-6">
				                		<div class="form-group  {{ $errors->has('name') ? ' is-invalid' : '' }}">
				                			<label for="name">Nombre <span class="text-danger">*</span></label>
				                			<input type="text" name="name" id="name" class="form-control"  value="@if(isset($user)){{ $user->person->name }}@else{{ old('name') }}@endif" >
				                			@if ($errors->has('name'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
				                		<div class="form-group  {{ $errors->has('last_name') ? ' is-invalid' : '' }}">
				                			<label for="lastname">Apellido <span class="text-danger">*</span></label>
				                			<input type="text" name="last_name" id="last_name" class="form-control"  value="@if(isset($user)){{ $user->person->last_name }}@else{{ old('last_name') }}@endif" >
				                			@if ($errors->has('last_name'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('last_name') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
				                		<div class="form-group  {{ $errors->has('password') ? ' is-invalid' : '' }}">
				                			<label for="password">Contraseña <span class="text-danger">*</span></label>
				                			<input type="password" name="password" id="password" class="form-control"  value="" >
				                			@if ($errors->has('password'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('password') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
				                		<div class="form-group  {{ $errors->has('rep_password') ? ' is-invalid' : '' }}">
				                			<label for="rep_password">Rep. Contraseña <span class="text-danger">*</span></label>
				                			<input type="password" name="rep_password" id="rep_password" class="form-control"  value="" >
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
				                		<div class="form-group  {{ $errors->has('phone') ? ' is-invalid' : '' }}">
				                			<label for="phone">Teléfono </label>
				                			<input type="text" name="phone" id="phone" class="form-control"  value="@if(isset($user)){{ $user->person->phone }}@else{{ old('phone') }}@endif">
				                			@if ($errors->has('phone'))
				                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('phone') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-2 col-6">
				                		<div class="form-group  {{ $errors->has('genre') ? ' is-invalid' : '' }}">
				                			<label for="genre">Género </label>
				                			<select type="text" name="genre" id="genre" class="form-control">
				                				<option value="m" @if( (isset($user) && $user->person->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
				                				<option value="f" @if( (isset($user) && $user->person->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
				                			</select>
				                			@if ($errors->has('genre'))
				                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('genre') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-6 col-12">
				                		<div class="form-group  {{ $errors->has('address') ? ' is-invalid' : '' }}">
				                			<label for="address">Dirección </label>
				                			<input type="text" name="address" id="address" class="form-control"  value="@if(isset($user)){{ $user->person->address }}@else{{ old('address') }}@endif">
				                			@if ($errors->has('address'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('address') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
			                			<div class="form-group  {{ $errors->has('facebook_link') ? ' is-invalid' : '' }}">
				                			<label for="facebook_link">Link de Facebook </label>
				                			<input type="text" name="facebook_link" id="facebook_link" class="form-control"  value="@if(isset($user)){{ $user->person->facebook_link }}@else{{ old('facebook_link') }}@endif" >
				                			@if ($errors->has('facebook_link'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('facebook_link') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-6 col-6">
			                			<div class="form-group  {{ $errors->has('activity') ? ' is-invalid' : '' }}">
				                			<label for="activity">Actividad</label>
				                			<input type="text" name="activity" id="activity" class="form-control"  value="@if(isset($user)){{ $user->person->activity }}@else{{ old('activity') }}@endif" >
				                			@if ($errors->has('activity'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('activity') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
			                			<div class="form-group form-check {{ $errors->has('super_admin') ? ' is-invalid' : '' }}">
				                			<input type="checkbox" name="super_admin" id="super_admin" class="form-check-input"  value="1" @if(isset($user) && $user->super_admin == 1) checked @endif>
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
				                			<div class="form-group   is-invalid">
						                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('roles') }}</div>
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
    			    		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
    			    		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
    			    		<a class="btn btn-inverse btn-sm" href="{{ route('users.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
    			    	</div>
            			</form>	
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
