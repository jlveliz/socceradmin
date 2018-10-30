@extends('layouts.backend')
@section('title','Módulos')

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Módulos</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Módulos</a></li>
            <li class="breadcrumb-item active">Listado</li>
        </ol>
    </div>
</div>
<!-- End Bread crumb -->

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (session()->has('type') && session()->has('content'))
                    <div class="alert alert-{{ session()->get('type') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {{ session()->get('content') }}
                    </div>
                @endif
                <div class="card-body"> 
                	<div class="form-group">
                		<a href="{{ route('modules.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>
                	</div>
                	<table class="table table-hover">
                		<thead>
                			<tr>
                				<th>Nombre</th>
                				<th>Estado</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($modules) > 0)
	                			@foreach ($modules as $module)
	                			<tr>
	                				<td>{{ $module->name }}</td>
	                				<td>
	                					@if($module->state == 1)
	                						<span class="badge badge-success">Activa</span>
	                					@else 
	                						<span class="badge badge-danger">Inactiva</span>
	                					@endif
	                				</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('modules.edit',['id' => $module->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-component="módulo" data-component-name="{{ $module->name }}" data-url="{{ route('modules.destroy',['id'=>$module->id]) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="2">
	                					<p class="text-primary">No existen módulos a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
