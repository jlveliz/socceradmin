@extends('layouts.backend')

@if(isset($role))
	@section('title','Editar Rol de '. $role->name)
@else
	@section('title','Crear Rol')
@endif

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Roles</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Crear Rol</li>
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
            	<form action="@if(isset($role)) {{ route('roles.update',['id'=>$role->id]) }} @else {{ route('roles.store') }} @endif" method="POST" >
            		{{ csrf_field() }}
            		@if (isset($role))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $role->id }}">
            		@endif
	                <div class="card-body">
	                	<div class="form-body">
		                	<div class="row">
		                		<div class="col-3">
			                		<div class="form-group @if ($errors->has('name')) is-invalid @endif">
			                			<label for="name">Nombre <span class="text-danger">*</span></label>
			                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($role)){{ $role->name }}@else{{ old('name') }}@endif">
			                			@if ($errors->has('name'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-2">
			                		<div class="form-group @if ($errors->has('is_default')) is-invalid @endif">
			                			<label for="is_default">Predeterminado <span class="text-danger">*</span></label>
			                			<select name="is_default" id="is_default" class="form-control custom-select">
			                				<option value="1" @if( (isset($role) && $role->is_default == '1') || ( old('is_default') == '1' ) ) selected @endif>Si</option>
			                				<option value="0" @if( (isset($role) && $role->is_default == '0') || ( old('is_default') == '0' ) ) selected @endif>No</option>
			                			</select>
			                			@if ($errors->has('is_default'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('is_default') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-4">
			                		<div class="form-group @if ($errors->has('description')) is-invalid @endif">
			                			<label for="description">Descripción <span class="text-danger">*</span></label>
			                			<input type="text" name="description" id="description" class="form-control"  autofocus="" value="@if(isset($role)){{ $role->description }}@else{{ old('description') }}@endif" >
			                			@if ($errors->has('description'))
			                				<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
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
	                		<a class="btn btn-inverse btn-sm" href="{{ route('roles.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
	                	</div>
	                </div>
            	</form>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection