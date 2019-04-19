@extends('layouts.backend')

@section('title', isset($agerange) ?  'Editar Rango '. $agerange->name : 'Crear Rango de Edad' )
@section('parent-page','Rangos de Edad')
@section('route-parent',route('ageranges.index') )
@section('current-page', isset($agerange) ?  'Editar Rango '. $agerange->name : 'Crear Rango de Edad' )

@section('content')

<!-- Start Page Content -->
<div class="row">
    <div class="col-12">
		
		<ul class="nav nav-tabs customtab">
            <li class="nav-item">
                <a class="nav-link" id="field-tab" href="{{route('fields.index')}}">Canchas</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="range-age-tab"  href="{{route('ftypes.index')}}">Tipos de Cancha</a>
            </li>


            <li class="nav-item">
                <a class="nav-link active" id="range-age-tab" data-toggle="tab" href="#ageranges" role="tab" aria-controls="ageranges" aria-selected="true">Rango de Edades</a>
            </li>
        </ul>

        <div class="card">
    		<div class="card-body">
    			@if (session()->has('type') && session()->has('content'))
            		<div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            			{{ session()->get('content') }}
            		</div>
    			@endif
				<form action="@if(isset($agerange)) {{ route('ageranges.update',['id'=>$agerange->id]) }} @else {{ route('ageranges.store') }} @endif" method="POST" class="crud-futbol">
	            		{{ csrf_field() }}
	            		@if (isset($agerange))
	            			<input type="hidden" name="_method" value="PUT">
	            			<input type="hidden" name="key" value="{{ $agerange->id }}">
	            		@endif
	                	<div class="row">
	                		<div class="col-lg-3 col-12">
		                		<div class="form-group">
		                			<label for="name">Nombre <span class="text-danger">*</span></label>
		                			<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  autofocus="" value="@if(isset($agerange)){{ $agerange->name }}@else {{ old('name') }}@endif">
		                			@if ($errors->has('name'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
		                			@endif
		                		</div>
	                		</div>
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group  {{ $errors->has('min_age') ? ' is-invalid' : '' }}">
									<label for="min_age">Edad Mínima <span class="text-danger">*</span></label>
									<select name="min_age" id="min_age" class="form-control">
										@foreach (range_ages() as $keyAge => $age)
										<option value="{{$keyAge}}" @if( (isset($agerange) && $keyAge == $agerange->min_age) || ( old('min_age') == $keyAge) ) selected @endif>{{$age}}</option>
										@endforeach
									</select>
		                			@if ($errors->has('min_age'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('max_age') }}</div>
		                			@endif
		                		</div>
							</div>
							
	                		<div class="col-lg-2 col-6">
		                		<div class="form-group  {{ $errors->has('max_age') ? ' is-invalid' : '' }}">
									<label for="max_age">Edad Máxima <span class="text-danger">*</span></label>
									<select name="max_age" id="max_age" class="form-control">
										@foreach (range_ages() as $keyAge => $age)
										<option value="{{$keyAge}}" @if( (isset($agerange) && $keyAge == $agerange->max_age) || ( old('max_age') == $keyAge) ) selected @endif>{{$age}}</option>
										@endforeach
									</select>
		                			@if ($errors->has('max_age'))
		                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('max_age') }}</div>
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
		    		<a class="btn btn-dark" href="{{ route('ageranges.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
		    	</div>
    			</form>	
    		</div>
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection