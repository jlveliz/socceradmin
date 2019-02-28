@extends('layouts.backend')
@section('title', isset($ftype) ?  'Editar Tipo de Cancha '. $ftype->name : 'Crear Tipo de Cancha' )
@section('parent-page','Tipos de Cancha')
@section('route-parent',route('ftypes.index') )
@section('current-page', isset($ftype) ?  'Editar Tipo de Cancha '. $ftype->name : 'Crear Tipo de Cancha' )

@section('content')
<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
		<ul class="nav nav-tabs customtab mb-2">
            <li class="nav-item">
                <a class="nav-link" id="field-tab" href="{{route('fields.index')}}">Canchas</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link active"  id="range-age-tab"  data-toggle="tab" href="#ageranges" role="tab" aria-controls="ageranges" aria-selected="true"> Tipos de Cancha</a>
            </li>

        </ul>

        <div class="card">
    		<div class="card-body">
    			@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
    			@endif

				<form action="@if(isset($ftype)) {{ route('ftypes.update',['id'=>$ftype->id]) }} @else {{ route('ftypes.store') }} @endif" method="POST" class="crud-futbol">
            		{{ csrf_field() }}
            		@if (isset($ftype))
            			<input type="hidden" name="_method" value="PUT">
            			<input type="hidden" name="key" value="{{ $ftype->id }}">
            		@endif
                	<div class="row">
                		<div class="col-lg-4 col-6">
	                		<div class="form-group">
	                			<label for="name">Nombre <span class="text-danger">*</span></label>
	                			<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($ftype)){{ $ftype->name }}@else{{ old('name') }}@endif">
	                			@if ($errors->has('name'))
	                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
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
		    		<a class="btn btn-dark" href="{{ route('ftypes.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>
@endsection