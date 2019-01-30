@extends('layouts.backend')

@section('title', isset($season) ?  'Editar Temporada '. $season->name : 'Crear Temoorada' )
@section('parent-page','Temporadas')
@section('route-parent',route('seasons.index') )

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">
            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($season)) {{  'Editar Temporada '. $season->name }} @else Crear Temporada @endif </h3>
            		</div>

            		<div class="card-body col-12">
            			@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
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
				                		<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
				                			<label for="name">Nombre <span class="text-danger">*</span></label>
				                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($season)){{ $season->name }}@else {{ old('name') }}@endif">
				                			@if ($errors->has('name'))
				                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-3 col-4">
				                		<div class="form-group  {{ $errors->has('duration_num_time') ? ' is-invalid' : '' }}">
				                			<label for="duration_num_time">Duración <span class="text-danger">*</span></label>
                                            <div class="row">
                                                    <select name="duration_num_time" id="duration_num_time" class="form-control col-4 custom-select">
                                                        @for ($i = 1; $i < 11; $i++)
														<option value="{{$i}}" @if( ( isset($season) && $i == $season->duration_num_time) || ( old('duration_num_time') == $i )) selected @endif>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                    @if ($errors->has('duration_num_time'))
                                                        <div class="invalid-feedback animated fadeInDown">{{ $errors->first('duration_num_time') }}</div>
                                                    @endif
                                                    <select name="duration_string_time" id="duration_string_time" class="form-control custom-select col-8 form-inline">
                                                        @foreach ($timeStrings as $key => $timestr)
                                                        <option value="{{$key}}">{{$timestr}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('duration_string_time'))
                                                        <div class="invalid-feedback animated fadeInDown">{{ $errors->first('duration_string_time') }}</div>
                                                    @endif

                                            </div>
				                		</div>
			                		</div>
			                		<div class="col-lg-2 col-4">
				                		<div class="form-group  {{ $errors->has('inscription_price') ? ' is-invalid' : '' }}">
				                			<label for="inscription_price">P. de Inscripción <span class="text-danger">*</span></label>
				                			<input type="number" name="inscription_price" id="inscription_price" class="form-control" value="@if( isset($season) ){{$season->inscription_price}}@else{{ old('inscription_price') }}@endif">
				                			@if ($errors->has('inscription_price'))
				                				<div  class="invalid-feedback animated fadeInDown">{{ $errors->first('inscription_price') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-2 col-4">
				                		<div class="form-group  {{ $errors->has('month_price') ? ' is-invalid' : '' }}">
				                			<label for="month_price">P. Mensual <span class="text-danger">*</span></label>
				                			<input type="number" name="month_price" id="month_price" class="form-control" value="@if(isset($season) ){{$season->month_price}}@else{{ old('month_price') }}@endif">
				                			@if ($errors->has('month_price'))
				                				<div  class="invalid-feedback animated fadeInDown">{{ $errors->first('month_price') }}</div>
				                			@endif
				                		</div>
			                		</div>
			                		<div class="col-lg-2 col-4">
				                		<div class="form-group  {{ $errors->has('state') ? ' is-invalid' : '' }}">
				                			<label for="state">Estado</label>
				                			<select name="state" id="state" class="form-control custom-select">
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
    			    		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
    			    		<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
    			    		<a class="btn btn-inverse btn-sm" href="{{ route('seasons.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
    			    	</div>
            			</form>	
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection