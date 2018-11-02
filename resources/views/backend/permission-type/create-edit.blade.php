@extends('layouts.backend')

@if(isset($permissionType))
	@section('title','Editar Tipo de Permiso de '. $permissionType->name)
@else
	@section('title','Crear Tipo de Permiso')
@endif

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Tipos de Permiso</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('permission-types.index') }}">Tipos de Permiso</a></li>
            <li class="breadcrumb-item active">Crear Tipo de Permiso</li>
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
            	<form action="@if(isset($permissionType)) {{ route('permission-types.update',['id'=>$permissionType->id]) }} @else {{ route('permission-types.store') }} @endif" method="POST" >
            		{{ csrf_field() }}
            		@if (isset($permissionType))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $permissionType->id }}">
            		@endif
	                <div class="card-body">
	                	<div class="form-body">
		                	<div class="row">
		                		<div class="col-3">
			                		<div class="form-group">
			                			<label for="name">Nombre <span class="text-danger">*</span></label>
			                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($permissionType)){{ $permissionType->name }}@else {{ old('name') }}@endif">
			                			@if ($errors->has('name'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-2">
			                		<div class="form-group">
			                			<label for="state">Estado <span class="text-danger">*</span></label>
			                			<select name="state" id="state" class="form-control custom-select">
			                				<option value="1" @if( (isset($permissionType) && $permissionType->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
			                				<option value="0" @if( (isset($permissionType) && $permissionType->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
			                			</select>
			                		</div>
		                		</div>
		                	</div>
	                	</div>
	                	<hr>
	                	<div class="form-actions">
	                		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
	                		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
	                		<button class="btn btn-success btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
	                		<a class="btn btn-inverse btn-sm" href="{{ route('permission-types.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
	                	</div>
	                </div>
            	</form>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection