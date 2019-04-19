@extends('layouts.backend')

@section('title', isset($permission) ?  'Editar Permiso '. $permission->name : 'Crear Permiso' )
@section('parent-page','Permisos')
@section('route-parent',route('permissions.index') )
@section('current-page', isset($permission) ?  'Editar Permiso '. $permission->name : 'Crear Permiso' )

@section('content')
<ul class="nav nav-tabs customtab">
    <li class="nav-item">
        <a class="nav-link" id="users-tab"  href="{{route('users.index')}}">Usuarios</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" id="roles-tab"  href="{{route('roles.index')}}">Roles</a>
    </li>

     <li class="nav-item">
        <a class="nav-link active" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permmission" aria-selected="true">Permisos</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="permissionstype-tab"  href="{{route('permission-types.index')}}">Tipos de Permisos</a>
    </li>
</ul>

<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
        <div class="card p-30">

    		<div class="card-body">
            	@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
            	@endif

            		<form action="@if(isset($permission)) {{ route('permissions.update',['id'=>$permission->id]) }} @else {{ route('permissions.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($permission))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $permission->id }}">
	            		@endif
	                	
	                	<div class="row">
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="module_id">Módulo <span class="text-danger">*</span></label>
		                			<select name="module_id" id="module_id" class="form-control @if ($errors->has('module_id')) is-invalid @endif">
		                				@foreach ($modules as $module)
		                					<option value="{{ $module->id }}" @if( (isset($permission) && $permission->module_id == $module->id) || ( old('module_id') == $module->id ) ) selected @endif>{{ $module->name }}</option>
		                				@endforeach
		                			</select>
		                			@if ($errors->has('module_id'))
		                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('module_id') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="type_id">Tipo de Permiso <span class="text-danger">*</span></label>
		                			<select name="type_id" id="type_id" class="form-control @if ($errors->has('type_id')) is-invalid @endif">
		                				@foreach ($permissionTypes as $permissionType)
		                					<option value="{{ $permissionType->id }}" @if( (isset($permission) && $permission->type_id == $permissionType->id) || ( old('type_id') == $permissionType->id ) ) selected @endif>{{ $permissionType->name }}</option>
		                				@endforeach
		                			</select>
		                			@if ($errors->has('type_id'))
		                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('type_id') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif"  autofocus="" value="@if(isset($permission)){{ $permission->name }}@else{{old('name')}}@endif">
		                			@if ($errors->has('name'))
		                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                	</div>

	                	<div class="row">
	                		<div class="col-lg-3 col-6">
	                			<div class="form-group">
		                			<label for="description">Descripción <span class="text-danger">*</span></label>
		                			<input type="text" name="description" id="description" class="form-control @if($errors->has('description')) is-invalid @endif" value="@if(isset($permission)){{ $permission->description }}@else{{old('description')}}@endif">
		                			@if ($errors->has('description'))
			                			<div id="val-description-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('description') }}</div>
			                		@endif
	                			</div>
	                		</div>

	                		<div class="col-lg-3 col-6">
	                			<div class="form-group">
		                			<label for="resource">Recurso</label>
		                			<input type="text" name="resource" id="resource" class="form-control @if($errors->has('resource')) is-invalid @endif" value="@if(isset($permission)){{ $permission->resource }}@else{{ old('resource') }}@endif">
		                			@if ($errors->has('resource'))
			                			<div id="val-resource-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('resource') }}</div>
			                		@endif
		                		</div>
	                		</div>

	                		<div class="col-lg-3 col-6">
	                			<div class="form-group">
		                			<label for="parent_id">Elemento Padre</label>
		                			<select name="parent_id" id="parent_id" class="form-control @if($errors->has('parent_id')) is-invalid @endif">
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

	                		<div class="col-lg-1 col-6">
	                			<div class="form-group">
		                			<label for="order">Orden</label>
		                			<input type="text" name="order" id="order" class="form-control @if($errors->has('order')) is-invalid @endif" value="@if(isset($permission)){{ $permission->order }}@else{{ old('order') }}@endif">
		                			@if ($errors->has('order'))
			                			<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
			                		@endif
	                			</div>
	                		</div>

	                		<div class="col-lg-2 col-6">
	                			<div class="form-group">
		                			<label for="fav_icon">ícono</label>
		                			<input type="text" name="fav_icon" id="fav_icon" class="form-control @if($errors->has('fav_icon')) is-invalid @endif" value="@if(isset($permission)){{ $permission->fav_icon }}@else{{ old('fav_icon') }}@endif">
		                			@if ($errors->has('fav_icon'))
			                			<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('fav_icon') }}</div>
			                		@endif
	                			</div>
	                		</div>
	                	</div>
    		</div>
            <div class="card-footer">
            	
            	<div class="form-actions">
            		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
            		<button class="btn btn-primary " type="submit"><i class="i-Data-Save"></i> Guardar</button>
            		<button class="btn btn-secondary  save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
            		<a class="btn btn-dark" href="{{ route('permissions.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
            	</div>
            </div>
	            	</form>
            		
            	
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection