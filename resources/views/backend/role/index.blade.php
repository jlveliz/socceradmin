@extends('layouts.backend')
@section('title','Roles')

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Roles</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Roles</a></li>
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
                		<a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>
                	</div>
                    {{ $roles->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Nombre</th>
                				<th>Predeterminado</th>
                				<th>Descripción</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($roles) > 0)
	                			@foreach ($roles as $role)
	                			<tr>
                                    <td>{{ $role->name }}</td>
                                    <td>@if($role->is_default == 1) Si @else No @endif</td>
	                				<td>{{ $role->description }}</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('roles.edit',['id' => $role->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-component="Rol" data-component-name="{{ $role->name }}" data-url="{{ route('roles.destroy',['id'=>$role->id]) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen roles a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
