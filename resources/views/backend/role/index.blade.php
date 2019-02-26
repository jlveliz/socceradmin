@extends('layouts.backend')
@section('title','Roles')
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
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

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
                                    <td><a href="{{ route('roles.edit',['id' => $role->id]) }}" class="text-primary">{{ $role->name }}</a></td>
                                    <td>@if($role->is_default == 1) Si @else No @endif</td>
	                				<td>{{ $role->description }}</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('roles.edit',['id' => $role->id]) }}"><i class="i-Pen-2"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$role}}" data-message="Está seguro de eliminar el Rol" data-route="{{ route('roles.destroy',$role->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
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
