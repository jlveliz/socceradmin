@extends('layouts.backend')
@section('title','Roles')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Roles')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/role.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/data-table/datatables.min.css') }}">
@endsection

@section('content')
<ul class="nav nav-tabs customtab mb-2">
    <li class="nav-item">
        <a class="nav-link" id="users-tab"  href="{{route('users.index')}}">Usuarios</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link active" id="roles-tab" data-toggle="tab" href="#roles" role="tab" aria-controls="role" aria-selected="true">Roles</a>
    </li>

     <li class="nav-item">
        <a class="nav-link" id="permissions-tab"  href="{{route('permissions.index')}}">Permisos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="permissionstype-tab"  href="{{route('permission-types.index')}}">Tipos de Permisos</a>
    </li>
</ul>
<div class="tab-pane fade show active" id="roles" role="tabpanel" aria-labelledby="role-tab">
    <div class="card">
        <div class="row">
            <div class="card-title col-6 mt-4 ml-4">
                <h3>Listado</h3>
            </div>
            <div class="col-5 mt-4 ml-4 text-right">
                <a href="{{ route('roles.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>             
            </div>
        </div>

        <div class="card-body"> 
            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif

            {{-- validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger sufee-alert alert with-close alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-hover table-responsive-lg" id="list-roles">
        		<thead>
        			<tr>
                        <th>Nombre</th>
        				<th>Predeterminado</th>
        				<th>Descripción</th>
        				<th>Acción</th>
        			</tr>
        		</thead>
        		<tbody>
    				@foreach ($roles as $role)
        			<tr>
                        <td><a href="{{ route('roles.edit',['id' => $role->id]) }}" class="text-primary">{{ $role->name }}</a></td>
                        <td>@if($role->is_default == 1) Si @else No @endif</td>
        				<td>{{ $role->description }}</td>
        				<td>
        					<a class="btn btn-warning btn-flat " href="{{ route('roles.edit',['id' => $role->id]) }}"><i class="i-Pen-2"></i> Editar</a>
        					<button class="btn btn-danger btn-flat  delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$role}}" data-message="Está seguro de eliminar el Rol" data-route="{{ route('roles.destroy',$role->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
        				</td>
        			</tr>
        			@endforeach
        		</tbody>
        	</table>
        </div>
    </div>
</div>
@endsection
