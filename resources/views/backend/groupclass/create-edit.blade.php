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
                                        <div class="row d-none pt-4">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Detalle de Grupos</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="goups-detail"></div>
                                        
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

