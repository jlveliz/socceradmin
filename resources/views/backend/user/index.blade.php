@extends('layouts.backend')
@section('title','Usuarios')
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
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $users->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Usuario</th>
                                <th>Nombre</th>
                				<th>Super Admin</th>
                				<th>Último Acceso</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($users) > 0)
	                			@foreach ($users as $user)
	                			<tr>
                                    <td><a href="{{ route('users.edit',['id' => $user->id]) }}" class="text-primary">{{ $user->name }}</a></td>
                                    <td>{{$user->person->name .' '. $user->person->last_name}}</td>
                                    <td>
                                    	@if($user->super_admin == 1) 
                                    		<span class="badge badge-success">Si</span> 
                                    	@else 
                                    		<span class="badge badge-success">No</span> 
                                    	@endif
                                    </td>
	                				<td>{{ $user->last_access ? $user->last_access->toDateString() : '-' }}</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('users.edit',['id' => $user->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$user}}" data-message="Está seguro de eliminar el Usuario" data-route="{{ route('users.destroy',$user->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen usuarios a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
