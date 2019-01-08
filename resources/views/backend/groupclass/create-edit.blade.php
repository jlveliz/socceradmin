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
								<div class="card-body">
				                	<div class="form-body">
					                	<div class="row justify-content-center">
                                            <div class="col-lg-3 col-6">
                                                <div class="form-group @if ($errors->has('field-id')) is-invalid @endif">
                                                    <label for="field-id">Seleccione una Cancha <span class="text-danger">*</span></label>
                                                    <select name="field-id" id="field-id" class="form-control"  autofocus="" required>
                                                        @foreach ($fields as $field)
                                                        <option value="{{$field->id}}">{{$field->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('name'))
                                                    <div id="val-username-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-6 mt-3">
                                                <button type="button" class="btn btn-sm btn-primary mt-4 btn-query-field"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-12">
                                                    <label>Horarios de la Cancha</label>
                                                    <table class="table d-none" id="table-schedule">
                                                        <thead>
                                                            <tr>
                                                                <th>Día</th>
                                                                <th>Hora de Entrada</th>
                                                                <th>Hora de Salida</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- @foreach ($collection as $item)
                                                                
                                                            @endforeach --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            

					                	{{--<div class="row">
											<div class="col-12">
												<div class="form-group @if ($errors->has('available_days')) is-invalid @endif">
													<label for="">Horario <span class="text-danger">*</span></label>
													
													@if ($errors->has('available_days'))
														<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('available_days') }}</div>
													@endif
												</div>
											</div>
										</div>
										<div class="row justify-content-center">
											<div class="col-lg-6 col-12">
												<ul class="list-group">
													<li class="list-group-item">
														<table class="table" id="shcedule-groupClass">
															<thead>
																<tr>
																	<td class="text-center"><b>	Día</b></td>
																	<td class="text-center"><b>Horario</b></td>
																</tr>
															</thead>
															<tbody>
																@php $countDay = 0; @endphp
																@foreach ($daysOfWeek as $kday => $day)
																	<tr id="row-{{$kday}}">
																		<td>
																			<div class="form-check">
																				<input class="form-check-input select-day" type="checkbox" value="" id="{{$kday}}" @if( (isset($groupClass) && is_array($groupClass->available_days) && array_key_exists($kday,$groupClass->available_days) ) || (old('available_days') != null && array_key_exists($kday,old('available_days') ) ) ) checked @endif>
																				<label class="form-check-label text-secondary" for="{{$kday}}">
																					{{$day}}
																				</label>
																			</div>
																		</td>
																		<td>
																			
																			@if ( isset($groupClass) && is_array($groupClass->available_days) && array_key_exists($kday, $groupClass->available_days)  )
																				@php $numSchedule = 0; @endphp
																				
																				@foreach($groupClass->available_days[$kday] as  $shcheduleNum => $scheduleDetail)
																					<div class="row">
																						@foreach ($scheduleDetail as $keyAction => $hours)
																							<div class="col-5 form-group @if ($errors->has('available_days.'.$kday.'.'.$shcheduleNum.'.'.$keyAction)) is-invalid @endif">
																								<input class="form-control form-control-sm  @if($keyAction == 'start') start-hour @else end-hour @endif" type="time" name="available_days[{{$kday}}][{{$shcheduleNum}}][{{$keyAction}}]" id="" value="{{$hours}}">
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
																								<button type="button" class="btn btn-link btn-sm remove-schedule"><i class="fa fa-close"></i></button>
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
																						<input class="form-control form-control-sm start-hour" type="time" name="available_days[{{$kday}}][schedule_0][start]" id="" @if( isset($groupClass) && isset($groupClass->available_days[$kday]) && isset($groupClass->available_days[$kday]['start']) ) value="{{$groupClass->available_days[$kday]['start'][$countDay]}}"  @endif disabled>
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
										</div> --}}
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
<script src="{{asset('js/components/groupclass.js')}}" type="text/javascript"></script>
@endsection

