@extends('layouts.backend')

@if(isset($permission))
	@section('title','Editar Permiso de '. $permission->name)
@else
	@section('title','Crear Permiso')
@endif

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Permisos</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
            <li class="breadcrumb-item active">Crear Permiso</li>
        </ol>
    </div>
</div>
<!-- End Bread crumb -->

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            	@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-{{ session()->get('type') }}">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
            	@endif
            	<form action="@if(isset($permission)) {{ route('permissions.update',['id'=>$permission->id]) }} @else {{ route('permissions.store') }} @endif" method="POST" >
            		{{ csrf_field() }}
            		@if (isset($permission))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $permission->id }}">
            		@endif
	                <div class="card-body">
	                	@foreach ($errors->all() as $error)
	                		{{ $error }}
	                	@endforeach
	                	<div class="form-body">
		                	<div class="row">
		                		<div class="col-3">
			                		<div class="form-group">
			                			<label for="module_id">Módulo <span class="text-danger">*</span></label>
			                			<select name="module_id" id="module_id" class="form-control">
			                				@foreach ($modules as $module)
			                					<option value="{{ $module->id }}" @if( (isset($permission) && $permission->module_id == $module->id) || ( old('module_id') == $module->id ) ) selected @endif>{{ $module->name }}</option>
			                				@endforeach
			                			</select>
			                			@if ($errors->has('module_id'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('module_id') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-3">
			                		<div class="form-group @if ($errors->has('type_id')) is-invalid @endif">
			                			<label for="type_id">Tipo de Permiso <span class="text-danger">*</span></label>
			                			<select name="type_id" id="type_id" class="form-control">
			                				@foreach ($permissionTypes as $permissionType)
			                					<option value="{{ $permissionType->id }}" @if( (isset($permission) && $permission->type_id == $permissionType->id) || ( old('type_id') == $permissionType->id ) ) selected @endif>{{ $permissionType->name }}</option>
			                				@endforeach
			                			</select>
			                			@if ($errors->has('type_id'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('type_id') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-3">
			                		<div class="form-group @if ($errors->has('name')) is-invalid @endif">
			                			<label for="name">Nombre <span class="text-danger">*</span></label>
			                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($permission)){{ $permission->name }}@else {{ old('name') }}@endif">
			                			@if ($errors->has('name'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-2">
			                		<div class="form-group @if ($errors->has('state')) is-invalid @endif">
			                			<label for="state">Estado <span class="text-danger">*</span></label>
			                			<select name="state" id="state" class="form-control custom-select">
			                				<option value="1" @if( (isset($permission) && $permission->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
			                				<option value="0" @if( (isset($permission) && $permission->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
			                			</select>
			                			@if ($errors->has('state'))
			                				<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                	</div>

		                	<div class="row">
		                		<div class="col-3">
		                			<div class="form-group @if($errors->has('description')) is-invalid @endif">
			                			<label for="description">Descripción <span class="text-danger">*</span></label>
			                			<input type="text" name="description" id="description" class="form-control" value="@if(isset($permission)){{ $permission->description }}@else{{ old('description') }}@endif ">
			                			@if ($errors->has('description'))
				                			<div id="val-description-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('description') }}</div>
				                		@endif
		                			</div>
		                		</div>

		                		<div class="col-3">
		                			<div class="form-group @if($errors->has('resource')) is-invalid @endif">
			                			<label for="resource">Recurso</label>
			                			<input type="text" name="resource" id="resource" class="form-control" value="@if(isset($permission)){{ $permission->resource }}@else{{ old('resource') }}@endif ">
			                			@if ($errors->has('resource'))
				                			<div id="val-resource-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('resource') }}</div>
				                		@endif
			                		</div>
		                		</div>

		                		<div class="col-3">
		                			<div class="form-group @if($errors->has('parent_id')) is-invalid @endif">
			                			<label for="parent_id">Elemento Padre</label>
			                			<select name="parent_id" id="parent_id" class="form-control">
			                				<option value="">Seleccione</option>
			                				@foreach ($parents as $parent)
			                					<option value="{{ $parent->id }}" @if( (isset($permission) && $permission->parent_id == $parent->id) || ( old('parent_id') == $parent->id) ) selected @endif> {{ $parent->name }} </option>
			                				@endforeach
			                			</select>
			                			@if ($errors->has('parent_id'))
				                			<div id="val-resource-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('parent_id') }}</div>
				                		@endif
		                			</div>
		                		</div>

		                		<div class="col-1">
		                			<div class="form-group @if($errors->has('order')) is-invalid @endif">
			                			<label for="order">Orden</label>
			                			<input type="text" name="order" id="order" class="form-control" value="@if(isset($permission)) {{ $permission->order }} @else {{ old('order') }} @endif">
			                			@if ($errors->has('order'))
				                			<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
				                		@endif
		                			</div>
		                		</div>

		                		<div class="col-2">
		                			<div class="form-group @if($errors->has('fav_icon')) is-invalid @endif">
			                			<label for="fav_icon">ícono</label>
			                			<input type="text" name="fav_icon" id="fav_icon" class="form-control" value="@if(isset($permission)) {{ $permission->fav_icon }} @else {{ old('fav_icon') }} @endif">
			                			@if ($errors->has('fav_icon'))
				                			<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('fav_icon') }}</div>
				                		@endif
		                			</div>
		                		</div>
		                	</div>
	                	</div>
	                	<hr>
	                	<div class="form-actions">
	                		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
	                		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                		<button class="btn btn-success btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
	                		<a class="btn btn-inverse btn-sm" href="{{ route('permissions.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
	                	</div>
	                </div>
            	</form>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection