@extends('layouts.backend')

@section('title', isset($field) ?  'Editar Cancha '. $field->name : 'Crear Cancha' )
@section('parent-page','Canchas')
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
            			<h3>@if (isset($field)) {{  'Editar Cancha '. $field->name }} @else Crear Cancha @endif </h3>
            		</div>

            		<div class="card-body col-12">
		            	@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
		            	@endif

		            	<div class="form-validation">
			            	<form action="@if(isset($field)) {{ route('fields.update',['id'=>$field->id]) }} @else {{ route('fields.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($field))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $field->id }}">
			            		@endif
				                <div class="card-body">
				                	<div class="form-body">
					                	<div class="row">

					                		<div class="col-lg-3 col-6">
						                		<div class="form-group @if ($errors->has('name')) is-invalid @endif">
						                			<label for="name">Nombre <span class="text-danger">*</span></label>
						                			<input type="text" name="name" id="name" class="form-control"  autofocus="" value="@if(isset($field)){{ $field->name }}@else {{ old('name') }}@endif">
						                			@if ($errors->has('name'))
						                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
						                			@endif
						                		</div>
					                		</div>
					                		
					                		<div class="col-lg-7 col-6">
						                		<div class="form-group @if ($errors->has('address')) is-invalid @endif">
						                			<label for="address">Dirección <span class="text-danger">*</span></label>
						                			<input type="text" name="address" id="address" class="form-control"  autofocus="" value="@if(isset($field)){{ $field->address }}@else {{ old('address') }}@endif">
						                			@if ($errors->has('address'))
						                				<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('address') }}</div>
						                			@endif
						                		</div>
					                		</div>
					                		
					                		<div class="col-lg-2 col-6">
						                		<div class="form-group @if ($errors->has('type')) is-invalid @endif">
						                			<label for="type">Tipo <span class="text-danger">*</span></label>
						                			<select name="type" id="type" class="form-control custom-select">
						                				<option value="synthetic" @if( (isset($field) && $field->state == 'synthetic') || ( old('type') == 'synthetic' ) ) selected @endif>Sintética</option>
						                				<option value="escuela" @if( (isset($field) && $field->state == 'escuela') || ( old('type') == 'escuela' ) ) selected @endif>Escuela</option>
						                			</select>
						                			@if ($errors->has('type'))
						                				<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('type') }}</div>
						                			@endif
						                		</div>
					                		</div>
					                	</div>

					                	<div class="row">
											<div class="col-12">
												<label for="">Disponibilidad</label>
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
																<tr id="row-lunes">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="lunes">
  																			<label class="form-check-label text-secondary" for="lunes">
    																			Lunes
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[monday][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[monday][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-martes">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="martes">
  																			<label class="form-check-label text-secondary" for="martes">
    																			Martes
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[tuesday][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[tuesday][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-miercoles">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="miercoles">
  																			<label class="form-check-label text-secondary" for="miercoles">
    																			Miercoles
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[wednesday][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[wednesday][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-jueves">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="jueves">
  																			<label class="form-check-label text-secondary" for="jueves">
    																			Jueves
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[thurd][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[thurd][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-viernes">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="viernes">
  																			<label class="form-check-label text-secondary" for="viernes">
    																			Viernes
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[friday][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[friday][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-sabado">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="sabado">
  																			<label class="form-check-label text-secondary" for="sabado">
    																			Sábado
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[satu][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[satu][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
																<tr id="row-domingo">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="domingo">
  																			<label class="form-check-label text-secondary" for="domingo">
    																			Domingo
																			</label>
																		</div>
																	</td>
																	<td>
																		<div class="row">
																			<div class="col-5 form-group">
																				<input class="form-control form-control-sm start-hour" type="time" name="available_days[sunday][start][0]" id="" disabled>
																			</div>
																			<div class="col-5 form-group">
																				<input type="time" class="form-control form-control-sm end-hour" name="available_days[sunday][end][0]" id="" disabled>
																			</div>
																			<div class="form-group">
																				<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																			</div>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</li>
												</ul>	
											</div>
										</div>
				                	</div>
				                	<hr>
				                	<div class="form-actions">
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
<script src="{{asset('js/components/field.js')}}" type="text/javascript"></script>
@endsection()