@extends('layouts.backend')

@section('title', isset($permissionType) ?  'Editar Tipo de Permiso '. $permissionType->name : 'Crear Tipo de Permiso' )
@section('parent-page','Tipos de Permiso')
@section('route-parent',route('permission-types.index') )


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

    				<form action="@if(isset($permissionType)) {{ route('permission-types.update',['id'=>$permissionType->id]) }} @else {{ route('permission-types.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($permissionType))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $permissionType->id }}">
	            		@endif
	            		<div class="row">
		            		<div class="col-3">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($permissionType)){{ $permissionType->name }}@else{{ old('name') }}@endif">
		                			@if ($errors->has('name'))
		                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
		            		</div>
		            		<div class="col-2">
		                		<div class="form-group {{ $errors->has('state') ? ' is-invalid' : '' }}" >
		                			<label for="state">Estado <span class="text-danger">*</span></label>
		                			<select name="state" id="state" class="form-control custom-select">
		                				<option value="1" @if( (isset($permissionType) && $permissionType->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
		                				<option value="0" @if( (isset($permissionType) && $permissionType->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
		                			</select>
		                			@if ($errors->has('state'))
		                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
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
                		<a class="btn btn-inverse btn-sm" href="{{ route('permission-types.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
                	</div>
                	</form>
            
        		</div>
        	
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection