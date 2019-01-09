@extends('layouts.backend')

@section('title', isset($groupClass) ?  'Editar Grupo '. $groupClass->name : 'Crear Grupo' )
@section('parent-page','Grupos')
@section('route-parent',route('fields.index') )

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">

            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($groupClass)) {{  'Editar Grupo '. $groupClass->name }} @else Crear Grupo @endif </h3>
            		</div>

            		<div class="card-body col-12">
		            	@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
		            	@endif

		            	<div class="form-validation">
			            	<form action="@if(isset($groupClass)) {{ route('fields.update',['id'=>$groupClass->id]) }} @else {{ route('fields.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($groupClass))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $groupClass->id }}">
                                @endif
                                {{-- field Id --}}
                                <div class="card-body">
				                	<div class="form-body">
					                	<div class="row justify-content-center">
                                            <div class="col-lg-3 col-8">
                                                <div class="form-group @if ($errors->has('field_id')) is-invalid @endif">
                                                    <label for="field-id">Seleccione una Cancha <span class="text-danger">*</span></label>
                                                    <select name="field_id" id="field-id" class="form-control"  autofocus="" required>
                                                        @foreach ($fields as $field)
                                                        <option value="{{$field->id}}" @if( (isset($groupClass) && $groupClass->field_id == $field->id) || old('field_id') == $field->id)) selected @endif>{{$field->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('field_id'))
                                                    <div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('field_id') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-4 mt-3">
                                                <button type="button" class="btn btn-sm btn-primary mt-4 btn-query-field"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>

                                        
                                        {{-- EFFECTS --}}
                                        <div class="row justify-content-center loading d-none">
                                            <div class="col-12">
                                                <h3 class="text-center">
                                                    <i class="fa fa-spinner fa-spin fa-5x fa-fw"></i>
                                                    <span class="sr-only">Loading...</span>
                                                </h3>
                                            </div>
                                        </div>

                                        {{-- Accordions --}}

                                        {{-- Accordion Schedule Field --}}
                                        <div class="accordion d-none">
                                            <div class="card-header p-0">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseScheduleField" aria-expanded="true" aria-controls="collapseScheduleField">
                                                        Horarios de la Cancha (Referencia)
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseScheduleField" class="collapse" aria-labelledby="headingOne" data-parent="#collapseScheduleField">
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-6">
                                                            
                                                            <table class="table" id="table-schedule">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Día</th>
                                                                        <th>Hora de Apertura</th>
                                                                        <th>Hora de Cierre</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        {{-- Accordeon Data Group --}}
                                        <div class="accordion d-none">
                                            <div class="card-header p-0">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDatGroup" aria-expanded="true" aria-controls="collapseDatGroup">
                                                        Datos del Grupo
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseDatGroup" class="collapse show" aria-labelledby="headingOne" data-parent="#collapseDatGroup">
                                                <div class="card-body form-body p-2">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-6">
                                                            <div class="form-group @if ($errors->has('name')) is-invalid @endif">
                                                                <label for="name" for="name">Nombre <span class="text-danger">*</span></label>
                                                                <select name="name" id="name" class="form-control">
                                                                    @foreach (get_group_names() as $grSlug => $grName)
                                                                        <option value="{{$grSlug}}" @if( (isset($groupClass) && $groupClass->name == $grSlug) || old('name') == $grSlug)) selected @endif>{{$grName}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('name'))
                                                                    <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-6">
                                                            <div class="form-group @if ($errors->has('range_age_id')) is-invalid @endif">
                                                                <label for="range_age_id" for="range_age_id">Rango de Edad <span class="text-danger">*</span></label>
                                                                <select name="range_age_id" id="range_age_id" class="form-control">
                                                                    @foreach ($aRanges as $range)
                                                                        <option value="{{$range->id}}" @if( (isset($groupClass) && $groupClass->range_age_id == $range->id) || old('range_age_id') == $range->id)) selected @endif>{{$range->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('range_age_id'))
                                                                    <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('range_age_id') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-2 col-6">
                                                            <div class="form-group @if ($errors->has('maximum_capacity')) is-invalid @endif">
                                                                <label for="maximum_capacity" for="maximum_capacity">Capacidad <span class="text-danger">*</span></label>
                                                            <input type="number" name="maximum_capacity" id="maximum_capacity" class="form-control" @if( (isset($groupClass)) ) value="{{$groupClass->maximum_capacity}}" @elseif(old('range_age_id') != null) value="{{old('range_age_id')}}" @else value="{{config('happyfeet.group-max-num')}}" @endif max="{{config('happyfeet.group-max-num')}}" min="1">
                                                                @if ($errors->has('maximum_capacity'))
                                                                    <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('maximum_capacity') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-2 col-6">
                                                            <div class="form-group @if ($errors->has('state')) is-invalid @endif">
                                                                <label for="state" for='state'>Estado <span class="text-danger">*</span></label>
                                                                <select name="state" id="state" class="form-control">
                                                                    @foreach (get_states() as $key => $state)
                                                                    <option value="{{$key}}">{{$state}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('state'))
                                                                    <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group @if ($errors->has('schedule')) is-invalid @endif">
                                                                <label for="">
                                                                    Horario <span class="text-danger">*</span> <br>
                                                                </label>
                                                                <p class="text-mini text-danger font-weight-bold">Los Horarios Se han llenado automáticamente de acuerdo a la disponibilidad horaria de la cancha seleccionada</p>
                                                                
                                                                @if ($errors->has('schedule'))
                                                                    <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('schedule') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6 col-12">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <table class="table" id="shcedule-field">
                                                                        <thead>
                                                                            <tr>
                                                                                <td class="text-center"><b>	Día</b></td>
                                                                                <td class="text-center"><b>Horario</b></td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
				                	</div>
				                	<hr>
				                	<div class="form-actions d-none">
				                		<input type="hidden" value="0" name="redirect-index" id="redirect-index">
				                		<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Guardar</button>
				                		<button class="btn btn-success btn-sm save-close" type="submit"><i class="fa fa-save"></i> Guardar y Cerrar</button>
				                		<a class="btn btn-inverse btn-sm" href="{{ route('fields.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
				                	</div>
				                </div>
			            	</form>
		            		
		            	</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection


@section('js')
<script src="{{asset('js/components/groupclass.js')}}" type="text/javascript"></script>
@endsection

