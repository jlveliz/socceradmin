@extends('layouts.backend')

@if(isset($module))
	@section('title','Editar Módulo de '. $module->name)
@else
	@section('title','Crear Módulo')
@endif

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Módulos</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('modules.index') }}">Módulos</a></li>
            <li class="breadcrumb-item active">Crear Módulo</li>
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
            	<form action="@if(isset($module)) {{ route('modules.update',['id'=>$module->id]) }} @else {{ route('modules.store') }} @endif" method="POST" >
            		{{ csrf_field() }}
            		@if (isset($module))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $module->id }}">
            		@endif
	                <div class="card-body">
	                	<div class="form-body">
		                	<div class="row">
		                		<div class="col-3">
			                		<div class="form-group">
			                			<label for="name">Nombre <span class="text-danger">*</span></label>
			                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($module)){{ $module->name }}@else {{ old('name') }}@endif">
			                			@if ($errors->has('name'))
			                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-2">
			                		<div class="form-group">
			                			<label for="order">Orden <span class="text-danger">*</span></label>
			                			<input type="text" name="order" id="order" class="form-control"  autofocus="" value="@if(isset($module)){{ $module->order }}@else {{ old('order') }}@endif" >
			                			@if ($errors->has('name'))
			                				<div id="val-order-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
			                			@endif
			                		</div>
		                		</div>
		                		<div class="col-2">
			                		<div class="form-group">
			                			<label for="state">Estado <span class="text-danger">*</span></label>
			                			<select name="state" id="state" class="form-control custom-select">
			                				<option value="1" @if( (isset($module) && $module->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
			                				<option value="0" @if( (isset($module) && $module->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
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
	                		<a class="btn btn-inverse btn-sm" href="{{ route('modules.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
	                	</div>
	                </div>
            	</form>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection