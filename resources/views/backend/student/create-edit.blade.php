@extends('layouts.backend')
@section('title', isset($student) ?  'Editar Estudiante '. $student->person->name .' '.  $student->person->last_name: 'Crear Estudiante' )
@section('parent-page','Estudiantes')
@section('route-parent',route('students.index') )
@section('current-page', isset($student) ?  'Editar Estudiante '. $student->person->name .' '.  $student->person->last_name: 'Crear Estudiante' )

@section('content')
	<!-- Start Page Content -->
	<div class="card">
		<form action="@if(isset($student)) {{ route('students.update',['id'=>$student->id]) }} @else {{ route('students.store') }} @endif" method="POST" class="crud-futbol student-form">
		<div class="row">
			@if (session()->has('type') && session()->has('content'))
				<div class="col-12">
					<div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						{{ session()->get('content') }}
					</div>
				</div>
			@endif

		    <div class="col-lg-7 col-12">
		        <div class="card p-2">
					<div class="card-body col-12">
						{{-- validation errors --}}
						@if($errors->any())
							<div class="alert alert-card alert-danger sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			@foreach ($errors->all() as $error)
									{{$error}} <br>
								@endforeach
							</div>
						@endif
						<div class="form-validation">
							{{ csrf_field() }}
							@if (isset($student))
								<input type="hidden" name="_method" value="PUT">
								<input type="hidden" name="key" value="{{ $student->id }}">
							@endif
							
							
							<ul class="nav nav-tabs customtab" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link  active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="@if(!$errors->has('representant.num_identification') || !$errors->has('representant.name') || !$errors->has('representant.last_name') || !$errors->has('representant.address') || !$errors->has('representant.email')) active @endif">Estudiante</a>
								</li>

								<li class="nav-item">
									<a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="@if($errors->has('representant')) true @else false @endif">Representante</a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="row p-2">
										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="name">Nombres <span class="text-danger">*</span></label>
												<input type="text" name="name" id="name" class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}" value="@if(isset($student)){{ $student->person->name }}@else{{ old('name') }}@endif" autofocus>
												@if ($errors->has('name'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
												@endif
											</div>
										</div>
										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="last_name">Apellidos <span class="text-danger">*</span></label>
												<input type="text" name="last_name" id="last_name" class="form-control form-control-sm {{ $errors->has('last_name') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->person->last_name }}@else{{ old('last_name') }}@endif">
												@if ($errors->has('last_name'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('last_name') }}</div>
												@endif
											</div>
										</div>
										<div class="col-lg-4 col-4">
											<div class="form-group">
												<label for="date_birth">F. de Nacimiento <span class="text-danger">*</span></label>
												<input type="date" name="date_birth" id="date_birth" class="form-control form-control-sm {{ $errors->has('date_birth') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->person->date_birth }}@else{{ old('date_birth') }}@endif">
												@if ($errors->has('date_birth'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('date_birth') }}</div>
												@endif
											</div>
										</div>
										<div class="col-lg-2 col-4">
											<div class="form-group">
												<label for="age">Edad <span class="text-danger">*</span></label>
												<input type="number" name="age" id="age" class="form-control form-control-sm {{ $errors->has('age') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->person->age }}@else{{ old('age') }}@endif" pattern="\d+" min="0" max="{{ config('Futbol.max-age') }}" readonly="">
												@if ($errors->has('age'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('age') }}</div>
												@endif
											</div>
										</div>
										<div class="col-lg-3 col-4">
											<div class="form-group">
												<label for="genre">Género </label>
												<select type="text" name="genre" id="genre" class="form-control form-control-sm {{ $errors->has('genre') ? ' is-invalid' : '' }}" data-placeholder="Seleccione Grupos">
													<option value="m" @if( (isset($student) && $student->person->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
													<option value="f" @if( (isset($student) && $student->person->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
												</select>
												@if ($errors->has('genre'))
												<div class="invalid-feedback animated fadeInDown">{{ $errors->first('genre') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-3 col-4">
											<div class="form-group">
												<label for="state">Estado <span class="text-danger">*</span></label>
												<select type="text" name="state" id="state" class="form-control form-control-sm {{ $errors->has('state') ? ' is-invalid' : '' }}" data-placeholder="Seleccione Grupos">
													<option value="1" @if( (isset($student) && $student->state == '1') || old('state') == '1' ) selected @endif>Activo</option>
													<option value="0" @if( (isset($student) && $student->state == '0') || old('state') == '0' ) selected @endif>Inactivo</option>
												</select>
												@if ($errors->has('state'))
												<div class="invalid-feedback animated fadeInDown">{{ $errors->first('state') }}</div>
												@endif
											</div>
										</div>
									</div>

									<div class="row p-2">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label for="medical_history" class="">Historial Médico </label>
												<textarea name="medical_history" id="medical_history" class="form-control form-control-sm  {{ $errors->has('medical_history') ? ' is-invalid' : '' }}" rows="3">@if(isset($student)){{ $student->medical_history }}@else{{ old('medical_history') }}@endif</textarea>
												@if ($errors->has('medical_history'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('medical_history') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label for="observation">Observación </label>
												<textarea name="observation" id="observation" class="form-control {{ $errors->has('observation') ? ' is-invalid' : '' }}" rows="3">@if(isset($student)){{ $student->observation }}@else{{ old('observation') }}@endif</textarea>
												@if ($errors->has('observation'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('observation') }}</div>
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

									<div class="row justify-content-center my-2">
										<button type="button" data-toggle="modal" data-target="#search-modal" data-route="{{route('users.representants')}}" @if(isset($student)) data-edit="true" @endif data-title="Buscar Representante" class="btn  btn-info"><i class="i-Data-Search"></i> Buscar Representante</button>
									</div>
									
									<div class="row p-2">
									<input type="hidden" name="representant[user_id]" id="representant_user_id"  value ="@if(isset($student)){{$student->representant->user->id}}@else{{old('representant.user_id')}}@endif">
										<input type="hidden" name="representant[person_id]" id="representant_person_id" value ="@if(isset($student)){{$student->representant->id}}@else{{old('representant.person_id')}}@endif">
										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="representant_num_identification">Num Identificación <span class="text-danger">*</span></label>
												<input type="text" max="9999999999" minlength="9999999999" name="representant[num_identification]" id="representant_num_identification" class="form-control form-control-sm {{ $errors->has('representant.num_identification') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->num_identification }}@else{{ old('representant.num_identification') }}@endif">
												@if ($errors->has('representant.num_identification'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.num_identification') }}</div>
												@endif
											</div>
										</div>
										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="representant_name">Nombre <span class="text-danger">*</span></label>
												<input type="text" name="representant[name]" id="representant_name" class="form-control form-control-sm {{ $errors->has('representant.name') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->name }}@else{{ old('representant.name') }}@endif">
												@if ($errors->has('representant.name'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.name') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="representant_last_name">Apellido <span class="text-danger">*</span></label>
												<input type="text" name="representant[last_name]" id="representant_last_name" class="form-control form-control-sm {{ $errors->has('representant.last_name') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->last_name }}@else{{ old('representant.last_name') }}@endif">
												@if ($errors->has('representant.last_name'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.last_name') }}</div>
												@endif
											</div>
										</div>
										
										<div class="col-lg-5 col-6">
											<div class="form-group">
												<label for="representant_address">Dirección <span class="text-danger">*</span></label>
												<input type="text" name="representant[address]" id="representant_address" class="form-control form-control-sm {{ $errors->has('representant.address') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->address }}@else{{ old('representant.address') }}@endif">
												@if ($errors->has('representant.address'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.address') }}</div>
												@endif
											</div>
										</div>
										
										<div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="representant_email">Email <span class="text-danger">*</span></label>
												<input type="email" name="representant[email]" id="representant_email" class="form-control form-control-sm {{ $errors->has('representant.email') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->user->email }}@else {{ old('representant.email') }}@endif">
												@if ($errors->has('representant.email'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.email') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-3 col-6">
											<div class="form-group">
												<label for="representant_phone">Teléfono</label>
												<input type="text" name="representant[phone]" id="representant_phone" class="form-control form-control-sm {{ $errors->has('representant.phone') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->phone }}@else{{ old('representant.phone') }}@endif">
												@if ($errors->has('representant.phone'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.phone') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-3 col-6">
											<div class="form-group">
												<label for="representant_mobile">Móvil</label>
												<input type="text" name="representant[mobile]" id="representant_mobile" class="form-control form-control-sm {{ $errors->has('representant.mobile') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->mobile }}@else{{ old('representant.mobile') }}@endif">
												@if ($errors->has('representant.mobile'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.mobile') }}</div>
												@endif
											</div>
										</div>

										<div class="col-lg-3 col-6">
											<div class="form-group">
												<label for="representant_genre">Género</label>
												<select name="representant[genre]" id="representant_genre" class="form-control form-control-sm {{ $errors->has('representant.genre') ? ' is-invalid' : '' }}">
												<option value="m" @if( (isset($student) && $student->representant->genre == 'm') || old('representant.genre') == 'm' ) selected @endif>Masculino</option>
												<option value="f" @if( (isset($student) && $student->representant->genre == 'f') || old('representant.genre') == 'f' ) selected @endif>Femenino</option>
											</select>
												@if ($errors->has('representant.genre'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.genre') }}</div>
												@endif
											</div>
										</div>

										{{-- <div class="col-lg-4 col-6">
											<div class="form-group">
												<label for="representant_date_birth">F. de Nacimiento</label>
												<input type="date" name="representant[date_birth]" id="representant_date_birth" class="form-control form-control-sm {{ $errors->has('representant.date_birth') ? ' is-invalid' : '' }}"  value="@if(isset($student)){{ $student->representant->date_birth }}@else{{ old('representant.date_birth') }}@endif">
												@if ($errors->has('representant.date_birth'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.date_birth') }}</div>
												@endif
											</div> 
										</div> --}}
										
										

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label for="representant_activity">Observación</label>
												<textarea name="representant[activity]" id="representant_activity" class="form-control {{ $errors->has('representant.activity') ? ' is-invalid' : '' }}">@if(isset($student)){{ $student->representant->activity }}@else{{ old('representant.activity') }}@endif</textarea>
												@if ($errors->has('representant.activity'))
													<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant.activity') }}</div>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>            	
				</div>
			</div>
			{{-- matricula --}}
			<div class="col-lg-5 col-12 mt-lg-0 mt-3">
				<div class="card p-2">
					<div class="card-body col-12">
						<h4 class="text-center"> <strong>Matricula</strong></h4>
						
							<div class="col-12 form-group">
								<label for="season-enrollment">Temporada  <span class="text-danger">*</span></label>
								<select name="enrollment[season_id]" id="season-enrollment" class="form-control form-control-sm {{ $errors->has('enrollment.season_id') ? ' is-invalid' : '' }}">
									<option value="">Seleccione</option>
									@foreach ($seasons as $season)
									<option value="{{$season->id}}" @if( (isset($student) &&  $student->currentEnrollment()  &&   $student->currentEnrollment()->season_id == $season->id) || old('enrollment.season_id') ==  $season->id) )) selected @endif>{{$season->name}}</option>
									@endforeach
								</select>
								@if ($errors->has('enrollment.season_id'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.season_id') }}</div>
								@endif
							</div>
							 <div class="col-12 form-group">
								<label for="select-field">Cancha  <span class="text-danger">*</span></label>
								
								<select name="enrollment[field_id]" id="select-field" class="form-control form-control-sm {{ $errors->has('enrollment.field_id') ? ' is-invalid' : '' }}">
									<option value="">Seleccione</option>
									@foreach ($fields as $field)
									<option value="{{$field->id}}" @if( (isset($student) &&   $student->currentEnrollment()->field_id == $field->id)  || (old('enrollment.field_id') ==  $field->id)) selected @endif>{{$field->name}}</option>
									@endforeach
								</select>
								@if ($errors->has('enrollment.field_id'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.field_id') }}</div>
								@endif
							</div>
							
							<div class="col-12 form-group">
								<label for="class-type">Clase  <span class="text-danger">*</span></label>
								<select name="enrollment[class_type]" id="class-type" class="form-control form-control-sm {{ $errors->has('enrollment.class_type') ? ' is-invalid' : '' }}">
									<option value="">Seleccione</option>
									@foreach (get_type_class() as $key => $group)
										<option value="{{$key}}" @if ( ( isset($student) && $key == $student->currentEnrollment()->class_type) ||  (old('enrollment.class_type') == $key)) selected @endif >{{$group}}</option>
									@endforeach
								</select>
								@if ($errors->has('enrollment.class_type'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.class_type') }}</div>
								@endif
							</div>

							<div class="col-12 form-group">
								<label for="grupo-class">Grupos  <span class="text-danger">*</span></label>
								@if(isset($student)) 
									<select @if ( $student->currentEnrollment()->class_type > 0) multiple @endif name="enrollment[groups][]" id="grupo-class" class="form-control form-control-sm grupo-class-edit {{ $errors->has('enrollment.groups') ? ' is-invalid' : '' }}">
										@foreach ($student->currentEnrollment()->field->groups as $group)
										<option value="{{$group->id}}" @if($student->currentEnrollment()->existGroupOnEnrollment($group->id)) selected @endif>{{$group->coach->username}} - {{$group->range->name}} - {{$group->disponibility}} Cupos Disponibles - {{days_of_week()[$group->day]}} - ({{$group->schedule['start']}} -  {{$group->schedule['end']}})</option>
										@endforeach 
									</select>
									<input type="hidden" name="is_changing_group" id="is-changing-group" value="0">
								@else 
									<select name="enrollment[groups][]" id="grupo-class" class="form-control form-control-sm grupo-class-create" @if( !old('enrollment.class_type') ||  !old('enrollment.field_id'))disabled @endif @if(old('enrollment.class_type') == 2 ) multiple @endif>
									</select>
								@endif

								@if ($errors->has('enrollment.groups'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.groups') }}</div>
								@endif
							</div> 
							
							<div class="col-12 form-check form-group">
									<input class="form-check-input {{ $errors->has('enrollment.is_pay_inscription') ? ' is-invalid' : '' }}" name="enrollment[is_pay_inscription]" type="checkbox" value="1" id="is_pay_inscription" @if( ( isset($student) && $student->currentEnrollment()->is_pay_inscription == 1 ) ||  old('enrollment.is_pay_inscription')) checked="" @endif>
									<label class="form-check-label" for="is_pay_inscription">Pagó Inscripción?</label>

									@if ($errors->has('enrollment.is_pay_inscription'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.is_pay_inscription') }}</div>
								@endif
							</div>
							
							<div class="col-12 form-check form-group">
									<input class="form-check-input {{ $errors->has('enrollment.is_pay_first_month') ? ' is-invalid' : '' }}" name="enrollment[is_pay_first_month]" type="checkbox" value="1" id="is_pay_first_month" @if( ( isset($student) && $student->currentEnrollment()->is_pay_first_month == 1) || old('enrollment.is_pay_first_month')) checked="" @endif>
									<label class="form-check-label" for="is_pay_first_month">Pagó Primer Mes?</label>

									@if ($errors->has('enrollment.is_pay_first_month'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.is_pay_first_month') }}</div>
								@endif
							</div>

							<div class="col-12 form-check form-group">
									<input class="form-check-input {{ $errors->has('enrollment.is_delivered_uniform') ? ' is-invalid' : '' }}" name="enrollment[is_delivered_uniform]" type="checkbox" value="1" id="is_delivered_uniform" @if( (isset($student) && $student->currentEnrollment()->is_delivered_uniform == 1 ) || old('enrollment.is_delivered_uniform')) checked="" @endif>
									<label class="form-check-label" for="is_delivered_uniform">Se entregó el Uniforme?</label>

									@if ($errors->has('enrollment.is_delivered_uniform'))
									<div class="invalid-feedback animated fadeInDown">{{ $errors->first('enrollment.is_delivered_uniform') }}</div>
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
				<a class="btn btn-dark" href="{{ route('students.index') }}"><i class="i-Arrow-Back-2"></i> Cancelar</a>
			</div>
		</div>
		</form>	
		<!-- End PAge Content -->
	</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2-bootstrap.min.css') }}">
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/select2/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset('js/components/student.js')}}"></script>
@endsection()
