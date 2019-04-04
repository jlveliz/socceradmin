@extends('layouts.backend')

@section('title', isset($season) ?  'Editar Temporada '. $season->name : 'Crear Temporada' )
@section('parent-page','Temporadas')
@section('route-parent',route('seasons.index') )
@section('current-page', isset($season) ?  'Editar Temporada '. $season->name : 'Crear Temporada' )

@section('content')

<!-- Container fluid  -->
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
    			<div class="form-validation">
	            	<form action="@if(isset($season)) {{ route('seasons.update',['id'=>$season->id]) }} @else {{ route('seasons.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($season))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $season->id }}">
	            		@endif
	                	<div class="row">
	                		<div class="col-lg-3 col-5">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($season)){{ $season->name }}@else{{ old('name') }}@endif">
		                			@if ($errors->has('name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-3 col-4">
		                		<div class="form-group ">
		                			<label for="start_date">Desde <span class="text-danger">*</span></label>
		                			<input type="date" name="start_date" id="start_date" class="form-control {{ $errors->has('start_date') || $errors->has('end_date') ? ' is-invalid' : '' }}" value="@if(isset($season)){{$season->start_date}}@else  {{old('start_date')}}@endif">
                                    @if ($errors->has('start_date'))
                                        <div class="invalid-feedback animated fadeInDown">{{ $errors->first('start_date') }}</div>
                                    @endif
		                		</div>
	                		</div>

	                		<div class="col-lg-3 col-4">
	                			<div class="form-group">
	                				<label for="end_date">Hasta <span class="text-danger">*</span></label>
		                			<input type="date" name="end_date" id="end_date" class="form-control {{$errors->has('end_date') ? ' is-invalid' : '' }}" value="@if(isset($season)){{$season->end_date}}@else{{old('end_date')}}@endif">
                                    @if ($errors->has('end_date'))
                                        <div class="invalid-feedback animated fadeInDown">{{ $errors->first('end_date') }}</div>
                                    @endif
	                			</div>
	                		</div>
	                		
	                		<div class="col-lg-2 col-4">
		                		<div class="form-group">
		                			<label for="state">Estado</label>
		                			<select name="state" id="state" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }} custom-select">
		                				<option value="1" @if( (isset($season) && $season->state == '1') || ( old('state') == '1' ) ) selected @endif>Activo</option>
		                				<option value="0" @if( (isset($season) && $season->state == '0') || ( old('state') == '0' ) ) selected @endif>Inactivo</option>
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
		    		<button class="btn btn-primary " type="submit"><i class="i-Data-Save"></i> Guardar</button>
		    		<button class="btn btn-secondary  save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
		    		<a class="btn btn-dark" href="{{ route('seasons.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        	
        </div>
    </div>
</div>
<!-- End PAge Content -->

@endsection