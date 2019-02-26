@extends('layouts.backend')

@section('title', isset($field) ?  'Editar Cancha '. $field->name : 'Crear Cancha' )
@section('parent-page','Canchas')
@section('route-parent',route('fields.index') )

@section('content')

<!-- Start Page Content -->
<div class="row">
    <div class="col-12">

		<ul class="nav nav-tabs customtab mb-2">
            <li class="nav-item">
                <a class="nav-link active" id="field-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="field" aria-selected="true">Canchas</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="range-age-tab"  href="{{route('ftypes.index')}}">Tipos de Cancha</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="range-age-tab"  href="{{route('ageranges.index')}}">Rango de Edades</a>
            </li>
        </ul>

        <div class="card">
        	<div class="card-body col-12">
	            	@if (session()->has('type') && session()->has('content'))
	            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
	            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	            			{{ session()->get('content') }}
	            		</div>
					@endif
					{{-- message ajax --}}
					<div class="alert sufee-alert with-close alert-dismissible fade show d-none" id="message-alert-field">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
					{{-- validation errors --}}
					@if($errors->any())
						<div class="alert alert-danger sufee-alert alert with-close alert-dismissible fade show">
	            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	            			@foreach ($errors->all() as $error)
								{{$error}} <br>
							@endforeach
						</div>
					@endif
					
					@if(isset($field))
					<ul class="nav nav-tabs customtab">
						<li class="nav-item">
							<a class="nav-link active" id="field-tab" data-toggle="tab" href="#field" role="tab" aria-controls="field" aria-selected="true">Cancha</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="groups-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="groups" aria-selected="true">Grupos</a>
						</li>
					</ul>
					{{-- tab field --}}
					<form action="{{ route('fields.update',['id'=>$field->id]) }}" method="POST" class="crud-futbol">
					<div class="tab-content" id="mytabcontent">
						<div class="tab-pane fade show active" id="field" role="tabpanel" aria-labelledby="field-tab">
					@endif
						{{-- content field --}}
						
							<form action="@if(isset($field)) {{ route('fields.update',['id'=>$field->id]) }} @else {{ route('fields.store') }} @endif" method="POST" class="crud-futbol">
								{{ csrf_field() }}
								@if (isset($field))
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="key" value="{{ $field->id }}" id="key-field">
								@endif
								<div class="card-body">
									<div class="row">

										<div class="col-lg-3 col-6">
											<div class="form-group">
												<label for="name">Nombre <span class="text-danger">*</span></label>
												<input type="text" name="name" id="name" class="form-control @if ($errors->has('name')) is-invalid @endif"  autofocus="" value="@if(isset($field)){{ $field->name }}@else{{ old('name') }}@endif">
												@if ($errors->has('name'))
													<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
												@endif
											</div>
										</div>
										
										<div class="col-lg-7 col-6">
											<div class="form-group">
												<label for="address">Dirección <span class="text-danger">*</span></label>
												<input type="text" name="address" id="address" class="form-control @if ($errors->has('address')) is-invalid @endif" value="@if(isset($field)){{ $field->address }}@else{{ old('address') }}@endif">
												@if ($errors->has('address'))
													<div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('address') }}</div>
												@endif
											</div>
										</div>
										
										<div class="col-lg-2 col-6">
											<div class="form-group">
												<label for="type_field_id">Tipo <span class="text-danger">*</span></label>
												<select name="type_field_id" id="type_field_id" class="form-control custom-select @if ($errors->has('type_field_id')) is-invalid @endif">
													<option value="">Seleccione</option>
													@foreach ($types as $type)
														<option value="{{ $type->id }}" @if( (isset($field) && $type->id == $field->type_field_id) || (old('type_field_id') == $type->id) ) selected @endif>{{ $type->name }}</option>
													@endforeach
												</select>
												@if ($errors->has('type_field_id'))
													<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('type_field_id') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-2 col-4">
											<div class="form-group">
												<label for="inscription_price">P. de Inscripción <span class="text-danger">*</span></label>
												<input type="number" name="inscription_price" id="inscription_price" class="form-control {{ $errors->has('inscription_price') ? ' is-invalid' : '' }}" value="@if( isset($field) ){{$field->inscription_price}}@else{{ old('inscription_price') }}@endif">
												@if ($errors->has('inscription_price'))
													<div  class="invalid-feedback animated fadeInDown">{{ $errors->first('inscription_price') }}</div>
												@endif
											</div>
	                					</div>
				                		<div class="col-lg-2 col-4">
					                		<div class="form-group">
					                			<label for="month_price">P. Mensual <span class="text-danger">*</span></label>
					                			<input type="number" name="month_price" id="month_price" class="form-control {{ $errors->has('month_price') ? ' is-invalid' : '' }}" value="@if(isset($field) ){{$field->month_price}}@else{{ old('month_price') }}@endif">
					                			@if ($errors->has('month_price'))
					                				<div  class="invalid-feedback animated fadeInDown">{{ $errors->first('month_price') }}</div>
					                			@endif
					                		</div>
				                		</div>
									</div>

									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label for="">Horario <span class="text-danger">*</span></label>
												
												@if ($errors->has('available_days'))
													<div id="val-state-error" class="invalid-feedback animated fadeInDown @if ($errors->has('available_days')) is-invalid @endif">{{ $errors->first('available_days') }}</div>
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
																<td class="text-center"><b>Horario de Atención</b></td>
															</tr>
														</thead>
														<tbody>
															@php $countDay = 0; @endphp
															@foreach ($daysOfWeek as $kday => $day)
																<tr id="row-{{$kday}}">
																	<td>
																		<div class="form-check">
																			<input class="form-check-input select-day" type="checkbox" value="" id="{{$kday}}" @if( (isset($field) && is_array($field->available_days) && array_key_exists($kday,$field->available_days) ) || (old('available_days') != null && array_key_exists($kday,old('available_days') ) ) ) checked @endif>
																			<label class="form-check-label text-secondary" for="{{$kday}}">
																				{{$day}}
																			</label>
																		</div>
																	</td>
																	<td>
																		@if ( isset($field) && is_array($field->available_days) && array_key_exists($kday, $field->available_days)  )
																			@php $numSchedule = 0; @endphp
																			
																			@foreach($field->available_days[$kday] as  $shcheduleNum => $scheduleDetail)
																				<div class="row">
																					@foreach ($scheduleDetail as $keyAction => $hours)
																						<div class="col-5 form-group ">
																							<input class="form-control @if ($errors->has('available_days.'.$kday.'.'.$shcheduleNum.'.'.$keyAction)) is-invalid @endifform-control-sm  @if($keyAction == 'start') start-hour @else end-hour @endif" type="time" name="available_days[{{$kday}}][{{$shcheduleNum}}][{{$keyAction}}]" id="" value="{{$hours}}">
																							@if ($errors->has('available_days.'.$kday.'.'.$shcheduleNum.'.'.$keyAction))
																								<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('available_days.'.$kday.'.'.$shcheduleNum.'.'.$keyAction) }}</div>
																							@endif
																						</div>
																					@endforeach
																					
																					@if($numSchedule < 1)
																						<div class="form-group">
																							<button type="button" class="btn btn-link btn-sm add-schedule"><i class="fa fa-plus"></i></button>
																						</div>
																					@else
																						<div class="form-group">
																							<button type="button" class="btn btn-link btn-sm remove-live-schedule"><i class="fa fa-close"></i></button>
																						</div>
																					@endif
																					@php $numSchedule++; @endphp 
																				</div>
																			@endforeach

																		@elseif(old('available_days') != null && array_key_exists($kday,old('available_days')))
																			@php $numSchedule = 0; @endphp
																			@foreach (old('available_days')[$kday] as $sheduleNum => $scheduleDetail)
																				<div class="row">
																					@foreach ($scheduleDetail as $keyAction => $hours)
																						<div class="col-5 form-group @if ($errors->has('available_days.'.$kday.'.'.$sheduleNum.'.'.$keyAction)) is-invalid @endif">
																						<input class="form-control form-control-sm  @if($keyAction == 'start') start-hour @else end-hour @endif" type="time" name="available_days[{{$kday}}][{{$sheduleNum}}][{{$keyAction}}]" id="" value="{{$hours}}">
																							@if ($errors->has('available_days.'.$kday.'.'.$sheduleNum.'.'.$keyAction))
																								<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('available_days.'.$kday.'.'.$sheduleNum.'.'.$keyAction) }}</div>
																							@endif
																						</div>
																					@endforeach
																					@if($numSchedule < 1)
																						<div class="form-group">
																							<button type="button" class="btn btn-link btn-sm add-schedule"><i class="fa fa-plus"></i></button>
																						</div>
																					@else
																						<div class="form-group">
																							<button type="button" class="btn btn-link btn-sm remove-schedule"><i class="fa fa-close"></i></button>
																						</div>
																					@endif
																					@php $numSchedule++; @endphp
																				</div>
																			@endforeach
																		@else
																			<div class="row">			
																				<div class="col-5 form-group @if ($errors->has('available_days.'.$kday.'.schedule_0.start')) is-invalid @endif">
																					<input class="form-control form-control-sm start-hour" type="time" name="available_days[{{$kday}}][schedule_0][start]" id="" @if( isset($field) && isset($field->available_days[$kday]) && isset($field->available_days[$kday]['start']) ) value="{{$field->available_days[$kday]['start'][$countDay]}}"  @endif disabled>
																					@if ($errors->has('available_days.'.$kday.'.schedule_0.start'))
																						<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('available_days.'.$kday.'.schedule_0.start') }}</div>
																					@endif
																				</div>
																				
																				<div class="col-5 form-group @if ($errors->has('available_days.'.$kday.'.schedule_0.end')) is-invalid @endif">
																					<input type="time" class="form-control form-control-sm end-hour" name="available_days[{{$kday}}][schedule_0][end]" id="" disabled>
																					@if ($errors->has('available_days.'.$kday.'.schedule_0.end'))
																						<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('available_days.'.$kday.'.schedule_0.end') }}</div>
																					@endif
																				</div>
																				<div class="form-group">
																					<button type="button" class="btn btn-link btn-sm add-schedule" disabled><i class="fa fa-plus"></i></button>
																				</div>
																			</div>
																		@endif
																			
																	</td>
																</tr>
																@php $countDay++; @endphp
															@endforeach
														</tbody>
													</table>
												</li>
											</ul>	
										</div>
									</div>
								</div>
							
							
						
					@if(isset($field))
						</div>
						<div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
							<div class="form-validation p-2">	
								<div class="card-body">
									<div class="row justify-content-center">
										<p class="text-center mt-4 mb-0">Los Grupos son Creados de acuerdo a la disponibilidad de la Cancha "<strong>{{$field->name}}</strong>"</p>	
										<div class="col-12">
											<div class="accordion" id="accordionExample">
												@include('backend.field.includes.groups',['availableDays' => $field->available_days,'field' => $field])
											</div>
										</div>			
									</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="card-footer">
					<input type="hidden" value="0" name="redirect-index" id="redirect-index">
					<button class="btn btn-primary btn-sm" type="submit"><i class="i-Data-Save"></i> Guardar</button>
					<button class="btn btn-secondary btn-sm save-close" type="submit"><i class="i-Data-Save"></i> Guardar y Cerrar</button>
					<a class="btn btn-inverse btn-sm" href="{{ route('fields.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
				</div>
				@if(!isset($field))	
					</form>
				@endif
			<input type="hidden" name="validate-form" id="validate-form" value="true">
			</form>
        	
        </div>
    </div>
</div>
<!-- End PAge Content -->
@endsection

@section('js')
<script src="{{asset('js/components/field.js')}}" type="text/javascript"></script>
@endsection()