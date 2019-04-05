@extends('layouts.backend')
@section('title', isset($coach) ?  'Editar Coach '. $coach->name : 'Crear Coach' )
@section('parent-page','Coachs')
@section('route-parent',route('coachs.index') )
@section('current-page',isset($coach) ?  'Editar Coach '. $coach->name : 'Crear Coach' )


@section('content')

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
	            	<form action="@if(isset($coach)) {{ route('coachs.update',['id'=>$coach->id]) }} @else {{ route('coachs.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($coach))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $coach->id }}">
	            		@endif
	                	<div class="row">
	                		<div class="col-lg-3 col-12">
		                		<div class="form-group">
		                			<label for="username">Coach <span class="text-danger">*</span></label>
		                			<input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($coach)){{ $coach->username }}@else{{ old('username') }}@endif">
		                			@if ($errors->has('username'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('username') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-12">
		                		<div class="form-group">
		                			<label for="email">Email <span class="text-danger">*</span></label>
		                			<input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->email }}@else{{ old('email') }}@endif">
		                			@if ($errors->has('email'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('email') }}</div>
		                			@endif
		                		</div>
							</div>
							<div class="col-lg-3 col-12">
									<div class="form-group">
										<label for="num_identification">Num Identificación</label>
										<input type="text" name="num_identification" id="num_identification" class="form-control {{ $errors->has('num_identification') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->person->num_identification }}@else{{ old('num_identification') }}@endif">
										@if ($errors->has('num_identification'))
											<div class="invalid-feedback animated fadeInDown">{{ $errors->first('num_identification') }}</div>
										@endif
									</div>
								</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->person->name }}@else{{ old('name') }}@endif" >
		                			@if ($errors->has('name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="lastname">Apellido <span class="text-danger">*</span></label>
		                			<input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->person->last_name }}@else{{ old('last_name') }}@endif" >
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
		                			<input type="text" name="mobile" id="mobile" class="form-control"  value="@if(isset($coach)){{ $coach->person->mobile }}@else{{ old('mobile') }}@endif"  >
		                			@if ($errors->has('mobile'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('mobile') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group  {{ $errors->has('state') ? ' is-invalid' : '' }}">
		                			<label for="state">Estado </label>
		                			<select name="state" id="state" class="form-control">
		                				<option value="1" @if( (isset($coach) && $coach->state == 1 ) ||  old('state') == '1' )  selected  @endif>Activo</option>
		                				<option value="0"  @if( (isset($coach) && $coach->state == 0 ) ||  old('state') == '0' )  selected  @endif>Inactivo</option>
		                			</select>
		                			@if ($errors->has('state'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group">
		                			<label for="phone">Teléfono </label>
		                			<input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->person->phone }}@else{{ old('phone') }}@endif">
		                			@if ($errors->has('phone'))
		                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('phone') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group">
		                			<label for="genre">Género </label>
		                			<select type="text" name="genre" id="genre" class="form-control {{ $errors->has('genre') ? ' is-invalid' : '' }}">
		                				<option value="m" @if( (isset($coach) && $coach->person->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
		                				<option value="f" @if( (isset($coach) && $coach->person->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
		                			</select>
		                			@if ($errors->has('genre'))
		                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('genre') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-6 col-12">
		                		<div class="form-group">
		                			<label for="address">Dirección </label>
		                			<input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"  value="@if(isset($coach)){{ $coach->person->address }}@else{{ old('address') }}@endif">
		                			@if ($errors->has('address'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('address') }}</div>
		                			@endif
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
		    		<a class="btn btn-dark" href="{{ route('coachs.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection
