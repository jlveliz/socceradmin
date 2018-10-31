@extends('layouts.backend')
@section('title','Tipos de Permiso')

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Tipos de Permiso</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Tipo de Permisos</a></li>
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
                		<a href="{{ route('permission-types.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>
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
                			@if (count($permissionTypes) > 0)
	                			@foreach ($permissionTypes as $pType)
	                			<tr>
	                				<td>{{ $pType->name }}</td>
	                				<td>
	                					@if($pType->state == 1)
	                						<span class="badge badge-success">Activa</span>
	                					@else 
	                						<span class="badge badge-danger">Inactiva</span>
	                					@endif
	                				</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('permission-types.edit',['id' => $pType->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-component="Tipo de Permiso" data-component-name="{{ $pType->name }}" data-url="{{ route('permission-types.destroy',['id'=>$pType->id]) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="3">
	                					<p class="text-primary">No existen Tipos de Permiso a consultar</p>
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
