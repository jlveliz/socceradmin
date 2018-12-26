@extends('layouts.backend')
@section('title', isset($student) ?  'Editar Estudiante '. $student->person->name .' '.  $student->person->last_name: 'Crear Estudiante' )
@section('parent-page','Estudiantes')
@section('route-parent',route('students.index') )

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">
            	<div class="row">
            		<div class="card-title col-12 px-0">
            			<h3>@if (isset($student)) {{  'Editar Estudiante '. $student->name }} @else Crear Estudiante @endif </h3>
            		</div>

            		<div class="card-body col-12">
            			@if (session()->has('type') && session()->has('content'))
		            		<div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
		            			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		            			{{ session()->get('content') }}
		            		</div>
            			@endif
            			<div class="form-validation">
			            	<form action="@if(isset($student)) {{ route('students.update',['id'=>$student->id]) }} @else {{ route('students.store') }} @endif" method="POST" class="crud-futbol">
			            		{{ csrf_field() }}
			            		@if (isset($student))
			            			<input type="hidden" name="_method" value="PUT">
			            			<input type="hidden" name="key" value="{{ $student->id }}">
			            		@endif
		                		
		                		<ul class="nav nav-tabs customtab" id="myTab" role="tablist">
		                			<li class="nav-item">
		                				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Estudiante</a>
		                		  	</li>

		                		  	<li class="nav-item">
		                		  		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Representante</a>
		                		  	</li>
		                		</ul>
		                		<div class="tab-content" id="myTabContent">
		                		  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		                		  	<div class="row p-2">
				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('num_identification') ? ' is-invalid' : '' }}">
					                			<label for="num_identification">Num Identificación <span class="text-danger">*</span></label>
					                			<input type="number" max="9999999999" minlength="9999999999" name="num_identification" id="num_identification" class="form-control"  autofocus="" value="@if(isset($student)){{ $student->person->num_identification }}@else {{ old('num_identification') }}@endif">
					                			@if ($errors->has('num_identification'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('num_identification') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}">
					                			<label for="name">Nombres <span class="text-danger">*</span></label>
					                			<input type="text" name="name" id="name" class="form-control" value="@if(isset($student)){{ $student->person->name }}@else {{ old('name') }}@endif">
					                			@if ($errors->has('name'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('name') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('last_name') ? ' is-invalid' : '' }}">
					                			<label for="last_name">Apellidos <span class="text-danger">*</span></label>
					                			<input type="text" name="last_name" id="last_name" class="form-control"  value="@if(isset($student)){{ $student->person->last_name }}@else {{ old('last_name') }}@endif">
					                			@if ($errors->has('last_name'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('last_name') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-3 col-4">
					                		<div class="form-group {{ $errors->has('date_birth') ? ' is-invalid' : '' }}">
					                			<label for="date_birth">Fecha de Nac. <span class="text-danger">*</span></label>
					                			<input type="date" name="date_birth" id="date_birth" class="form-control"  value="@if(isset($student)){{ $student->person->date_birth }}@else {{ old('date_birth') }}@endif">
					                			@if ($errors->has('date_birth'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('date_birth') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-1 col-4">
					                		<div class="form-group {{ $errors->has('age') ? ' is-invalid' : '' }}">
					                			<label for="age">Edad <span class="text-danger">*</span></label>
					                			<input type="text" name="age" id="age" class="form-control"  value="@if(isset($student)){{ $student->person->age }}@else {{ old('age') }}@endif">
					                			@if ($errors->has('age'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('age') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-2 col-4">
					                		<div class="form-group  {{ $errors->has('genre') ? ' is-invalid' : '' }}">
					                			<label for="genre">Género </label>
					                			<select type="text" name="genre" id="genre" class="form-control">
					                				<option value="m" @if( (isset($student) && $student->person->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
					                				<option value="f" @if( (isset($student) && $student->person->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
					                			</select>
					                			@if ($errors->has('genre'))
					                			<div class="invalid-feedback animated fadeInDown">{{ $errors->first('genre') }}</div>
					                			@endif
					                		</div>
				                		</div>
			                		  	<div class="col-lg-5 col-12">
					                		<div class="form-group  {{ $errors->has('medical_history') ? ' is-invalid' : '' }}">
					                			<label for="medical_history">Historial Médico </label>
					                			<textarea name="medical_history" id="medical_history" class="form-control" rows="3">@if(isset($student)){{ $student->medical_history }}@else {{ old('medical_history') }}@endif</textarea>
					                			@if ($errors->has('medical_history'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('medical_history') }}</div>
					                			@endif
					                		</div>
					                	</div>

					                	<div class="col-lg-4 col-12">
					                		<div class="form-group  {{ $errors->has('observation') ? ' is-invalid' : '' }}">
					                			<label for="observation">Observación </label>
					                			<textarea name="observation" id="observation" class="form-control" rows="3">@if(isset($student)){{ $student->observation }}@else {{ old('observation') }}@endif</textarea>
					                			@if ($errors->has('observation'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('observation') }}</div>
					                			@endif
					                		</div>
					                	</div>
		                		  </div>
		                		</div>
		                		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		                			<div class="row p-2">
		                				<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('representant_num_identification') ? ' is-invalid' : '' }}">
					                			<label for="representant_num_identification">Num Identificación <span class="text-danger">*</span></label>
					                			<input type="number" max="9999999999" minlength="9999999999" name="representant_num_identification" id="representant_num_identification" class="form-control"  autofocus="" value="@if(isset($student)){{ $student->representant->num_identification }}@else {{ old('representant_num_identification') }}@endif">
					                			@if ($errors->has('representant_num_identification'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_num_identification') }}</div>
					                			@endif
					                		</div>
				                		</div>
				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('representant_name') ? ' is-invalid' : '' }}">
					                			<label for="representant_name">Nombre <span class="text-danger">*</span></label>
					                			<input type="text" name="representant_name" id="representant_name" class="form-control"  value="@if(isset($student)){{ $student->representant->name }}@else {{ old('representant_name') }}@endif">
					                			@if ($errors->has('representant_num_identification'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_num_identification') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('representant_last_name') ? ' is-invalid' : '' }}">
					                			<label for="representant_last_name">Apellido <span class="text-danger">*</span></label>
					                			<input type="text" name="representant_last_name" id="representant_last_name" class="form-control"  value="@if(isset($student)){{ $student->representant->last_name }}@else {{ old('representant_last_name') }}@endif">
					                			@if ($errors->has('representant_last_name'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_last_name') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-2 col-6">
					                		<div class="form-group {{ $errors->has('representant_phone') ? ' is-invalid' : '' }}">
					                			<label for="representant_phone">Teléfono</label>
					                			<input type="text" name="representant_phone" id="representant_phone" class="form-control"  value="@if(isset($student)){{ $student->representant->phone }}@else {{ old('representant_phone') }}@endif">
					                			@if ($errors->has('representant_phone'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_phone') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-2 col-6">
					                		<div class="form-group {{ $errors->has('representant_mobile') ? ' is-invalid' : '' }}">
					                			<label for="representant_mobile">Móvil</label>
					                			<input type="text" name="representant_mobile" id="representant_mobile" class="form-control"  value="@if(isset($student)){{ $student->representant->mobile }}@else {{ old('representant_mobile') }}@endif">
					                			@if ($errors->has('representant_mobile'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_mobile') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-2 col-6">
					                		<div class="form-group {{ $errors->has('representant_genre') ? ' is-invalid' : '' }}">
					                			<label for="representant_genre">Género</label>
					                			<select name="representant_genre" id="representant_genre" class="form-control">
				                				<option value="m" @if( (isset($student) && $student->representant->genre == 'm') || old('genre') == 'm' ) selected @endif>Masculino</option>
				                				<option value="f" @if( (isset($student) && $student->representant->genre == 'f') || old('genre') == 'f' ) selected @endif>Femenino</option>
				                			</select>
					                			@if ($errors->has('representant_mobile'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_mobile') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-3 col-6">
					                		<div class="form-group {{ $errors->has('representant_date_birth') ? ' is-invalid' : '' }}">
					                			<label for="representant_date_birth">Fecha de Nacimiento</label>
					                			<input type="date" name="representant_date_birth" id="representant_date_birth" class="form-control"  value="@if(isset($student)){{ $student->representant->representant_date_birth }}@else {{ old('representant_date_birth') }}@endif">
					                			@if ($errors->has('representant_date_birth'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_date_birth') }}</div>
					                			@endif
					                		</div>
				                		</div>

				                		<div class="col-lg-4 col-6">
					                		<div class="form-group {{ $errors->has('representant_activity') ? ' is-invalid' : '' }}">
					                			<label for="representant_activity">Actividad</label>
					                			<input type="text" name="representant_activity" id="representant_activity" class="form-control"  value="@if(isset($student)){{ $student->representant->representant_activity }}@else {{ old('representant_activity') }}@endif">
					                			@if ($errors->has('representant_activity'))
					                				<div class="invalid-feedback animated fadeInDown">{{ $errors->first('representant_activity') }}</div>
					                			@endif
					                		</div>
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
    			    		<a class="btn btn-inverse btn-sm" href="{{ route('students.index') }}"><i class="fa fa-ban"></i> Cancelar</a>
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
