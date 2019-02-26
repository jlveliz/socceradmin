@extends('layouts.backend')

@section('title', isset($permission) ?  'Editar Permiso '. $permission->name : 'Crear Permiso' )
@section('parent-page','Permisos')
@section('route-parent',route('permissions.index') )

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">

            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($permission)) {{  'Editar Permiso '. $permission->name }} @else Crear Permiso @endif </h3>
            		</div>

            		<div class="card-body col-12">
		            	@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
		            	@endif

		            	<div class="form-validation">
			            	<form action="@if(isset($permission)) {{ route('permissions.update',['id'=>$permission->id]) }} @else {{ route('permissions.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($permission))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $permission->id }}">
			            		@endif
				                <div class="card-body">
				                	<div class="form-body">
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
						                			<input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif"  autofocus="" value="@if(isset($permission)){{ $permission->name }}@else{{ old('name') }}@endif">
						                			@if ($errors->has('name'))
						                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
						                			@endif
						                		</div>
					                		</div>
					                		<div class="col-lg-2 col-6">
						                		<div class="form-group">
						                			<label for="state">Estado <span class="text-danger">*</span></label>
						                			<select name="state" id="state" class="form-control @if ($errors->has('state')) is-invalid @endif custom-select">
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
					                		<div class="col-lg-3 col-6">
					                			<div class="form-group">
						                			<label for="description">Descripción <span class="text-danger">*</span></label>
						                			<input type="text" name="description" id="description" class="form-control @if($errors->has('description')) is-invalid @endif" value="@if(isset($permission)){{ $permission->description }}@else{{ old('description') }}@endif ">
						                			@if ($errors->has('description'))
							                			<div id="val-description-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('description') }}</div>
							                		@endif
					                			</div>
					                		</div>

					                		<div class="col-lg-3 col-6">
					                			<div class="form-group">
						                			<label for="resource">Recurso</label>
						                			<input type="text" name="resource" id="resource" class="form-control @if($errors->has('resource')) is-invalid @endif" value="@if(isset($permission)){{ $permission->resource }}@else{{ old('resource') }}@endif ">
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
						                			<input type="text" name="order" id="order" class="form-control @if($errors->has('order')) is-invalid @endif" value="@if(isset($permission)){{ $permission->order }}@else{{ old('order') }} @endif">
						                			@if ($errors->has('order'))
							                			<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
							                		@endif
					                			</div>
					                		</div>

					                		<div class="col-lg-2 col-6">
					                			<div class="form-group">
						                			<label for="fav_icon">ícono</label>
						                			<input type="text" name="fav_icon" id="fav_icon" class="form-control @if($errors->has('fav_icon')) is-invalid @endif" value="@if(isset($permission)){{ $permission->fav_icon }}@else{{ old('fav_icon') }} @endif">
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
				                		<button class="btn btn-primary btn-sm" type="submit"><i class="i-Data-Save"></i> Guardar</button>
				                		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
				                		<a class="btn btn-inverse btn-sm" href="{{ route('permissions.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
				                	</div>
				                </div>
			            	</form>
		            		
		            	</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection