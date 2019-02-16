@extends('layouts.backend')
@section('title', isset($ptype) ?  'Editar Tipo de Persona '. $ptype->name : 'Crear Tipo de Persona' )
@section('parent-page','Tipos de Persona')
@section('route-parent',route('ptypes.index') )

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">
            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($ptype)) {{  'Editar Tipo de '. $ptype->name }} @else Crear Tipo de Persona @endif </h3>
            		</div>

            		<div class="card-body col-12">
            			@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
            			@endif

            			<div class="form-validation">
			            	<form action="@if(isset($ptype)) {{ route('ptypes.update',['id'=>$ptype->id]) }} @else {{ route('ptypes.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($ptype))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $ptype->id }}">
			            		@endif
			                	<div class="row">
			                		<div class="col-lg-4 col-6">
				                		<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
				                			<label for="name">Nombre <span class="text-danger">*</span></label>
				                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($ptype)){{ $ptype->name }}@else{{ old('name') }}@endif">
				                			@if ($errors->has('name'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-6">
				                		<div class="form-group  {{ $errors->has('state') ? ' is-invalid' : '' }}">
				                			<label for="state">Estado <span class="text-danger">*</span></label>
				                			<select name="state" id="state" class="form-control custom-select">
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
            		</div>
            		<div class="card-footer col-12">
    			    	<div class="form-actions">
    			    		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
    			    		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
    			    		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
    			    		<a class="btn btn-inverse btn-sm" href="{{ route('ptypes.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
    			    	</div>
            			</form>	
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection