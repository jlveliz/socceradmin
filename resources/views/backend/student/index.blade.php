@extends('layouts.backend')
@section('title','Estudiantes')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card p-30">
                <div class="row">
                    <div class="card-title col-6">
                        <h3>Listado</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $students->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Clase</th>
                                <th>Nombre</th>
                                <th>Representante</th>
                				<th>Género</th>
                				<th>Edad</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($students) > 0)
	                			@foreach ($students as $student)
	                			<tr>
                                    <td>
                                        <div class="badge @if($student->currentEnrollment()->class_type == 1)  text-success @else text-warning @endif" >{{ $student->currentEnrollment()->class_type == 1 ? 'Pagada' : 'Demostrativa' }}</div>
                                    </td>
                                    <td><a href="{{ route('students.edit',['id' => $student->id]) }}" class="text-primary">{{$student->person->name .' '. $student->person->last_name}}</td>
                                    <td>{{ $student->representant ? $student->representant->name .' '.  $student->representant->last_name : '-'}}</td>
	                				<td>
                                        {{ $student->person->genre =='m' ? 'Masculino' : 'Femenino' }}
                                    </td>
                                    <td>{{ $student->person->age }} Año(s)</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('students.edit',['id' => $student->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$student}}" data-fieldname="{{$student->person->name}} {{$student->person->last_name}}" data-message="Está seguro de eliminar el Estudiante" data-route="{{ route('students.destroy',$student->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="6">
	                					<p class="text-primary">No existen estudiantes a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
