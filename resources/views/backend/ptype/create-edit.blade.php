@extends('layouts.backend')
@section('title', isset($ptype) ?  'Editar Tipo de Persona '. $ptype->name : 'Crear Tipo de Persona' )
@section('parent-page','Tipos de Persona')
@section('route-parent',route('ptypes.index') )
@section('current-page', isset($ptype) ?  'Editar Tipo de Persona '. $ptype->name : 'Crear Tipo de Persona' )

@section('content')
<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
        <div class="card p-30">
    		<div class="card-body col-12">
    			@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
    			@endif

    				<form action="@if(isset($ptype)) {{ route('ptypes.update',['id'=>$ptype->id]) }} @else {{ route('ptypes.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($ptype))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $ptype->id }}">
	            		@endif
	                	<div class="row">
	                		<div class="col-lg-4 col-6">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($ptype)){{ $ptype->name }}@else{{ old('name') }}@endif">
		                			@if ($errors->has('name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-6">
		                		<div class="form-group">
		                			<label for="state">Estado <span class="text-danger">*</span></label>
		                			<select name="state" id="state" class="form-control custom-select {{ $errors->has('state') ? ' is-invalid' : '' }}">
		                				<option value="1" @if( (isset($ptype) && $ptype->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
		                				<option value="0" @if( (isset($ptype) && $ptype->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
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
		    		<button class="btn btn-primary " type="submit"><i class="i-Data-Save"></i> Guardar</button>
		    		<button class="btn btn-secondary  save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
		    		<a class="btn btn-dark" href="{{ route('ptypes.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>

@endsection