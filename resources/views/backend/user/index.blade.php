@extends('layouts.backend')
@section('title','Usuarios')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Usuarios')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/user.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/data-table/datatables.min.css') }}">
@endsection

@section('content')

<ul class="nav nav-tabs customtab mb-2">
    <li class="nav-item">
        <a class="nav-link active" id="field-tab" data-toggle="tab" href="#users" role="tab" aria-controls="user" aria-selected="true">Usuarios</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" id="roles-tab"  href="{{route('roles.index')}}">Roles</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="permissions-tab"  href="{{route('permissions.index')}}">Permisos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="permissionstype-tab"  href="{{route('permission-types.index')}}">Tipos de Permisos</a>
    </li>
</ul>

<div class="card">
    
    <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="user-tab">
        <div class="row">
            <div class="card-title col-6 mt-4 ml-4">
                <h3>Listado</h3>
            </div>
            <div class="col-5 mt-4 ml-4 text-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>             
            </div>
        </div>

        <div class="card-body"> 
            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-card alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif

            {{-- validation errors --}}
            @if($errors->any())
                <div class="alert alert-card alert-danger sufee-alert alert with-close alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-hover table-responsive-lg" id="list-users">
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
    				@foreach ($users as $user)
        			<tr>
                        <td><a href="{{ route('users.edit',['id' => $user->id]) }}" class="text-primary">{{ $user->username }}</a></td>
                        <td>{{$user->person->name .' '. $user->person->last_name}}</td>
                        <td>
                        	@if($user->super_admin == 1) 
                        		<span class="badge badge-success">Si</span> 
                        	@else 
                        		<span class="badge badge-info">No</span> 
                        	@endif
                        </td>
        				<td>
                            @if ($user->last_access)
                                {{ $user->last_access }}
                            @else
                                -
                            @endif
                        </td>
        				<td>
        					<a class="btn btn-warning btn-flat " href="{{ route('users.edit',['id' => $user->id]) }}"><i class="i-Pen-2"></i> Editar</a>
        					<button class="btn btn-danger btn-flat  delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$user}}" data-fieldname="{{$user->person->name}} {{$user->person->last_name}}" data-message="Está seguro de eliminar el Usuario" data-route="{{ route('users.destroy',$user->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
        				</td>
        			</tr>
        			@endforeach
            		
        		</tbody>
        	</table>
        </div>
    </div>

</div>
@endsection
