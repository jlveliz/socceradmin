@extends('layouts.backend')

@section('title', isset($module) ?  'Editar Módulo '. $module->name : 'Crear Modulo' )
@section('parent-page','Módulos')
@section('route-parent',route('modules.index') )

@section('content')

<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
        <div class="card p-30">
    		<div class="card-body col-12">
    			@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
    			@endif
				<form action="@if(isset($module)) {{ route('modules.update',['id'=>$module->id]) }} @else {{ route('modules.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($module))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $module->id }}">
	            		@endif
                	<div class="row">
                		<div class="col-lg-4 col-7">
	                		<div class="form-group">
	                			<label for="name">Nombre <span class="text-danger">*</span></label>
	                			<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($module)){{ $module->name }}@else{{ old('name') }}@endif">
	                			@if ($errors->has('name'))
	                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
	                			@endif
	                		</div>
                		</div>
                		<div class="col-lg-2 col-5">
	                		<div class="form-group">
	                			<label for="order">Orden <span class="text-danger">*</span></label>
	                			<input type="text" name="order" id="order" class="form-control  {{ $errors->has('order') ? ' is-invalid' : '' }}" value="@if(isset($module)){{ $module->order }}@else{{ old('order') }}@endif" >
	                			@if ($errors->has('order'))
	                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('order') }}</div>
	                			@endif
	                		</div>
                		</div>
                		<div class="col-lg-3 col-12">
	                		<div class="form-group">
	                			<label for="state">Estado <span class="text-danger">*</span></label>
	                			<select name="state" id="state" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }} custom-select">
	                				<option value="1" @if( (isset($module) && $module->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
	                				<option value="0" @if( (isset($module) && $module->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
	                			</select>
	                			@if ($errors->has('state'))
	                				<div  class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
	                			@endif
	                		</div>
                		</div>
                	</div>
    			
    		</div>
    		<div class="card-footer col-12">
		    	<div class="form-actions">
		    		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
		    		<button class="btn btn-primary btn-sm" type="submit"><i class="i-Data-Save"></i> Guardar</button>
		    		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
		    		<a class="btn btn-inverse btn-sm" href="{{ route('modules.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection