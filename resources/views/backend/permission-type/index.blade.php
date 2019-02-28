@extends('layouts.backend')
@section('title','Tipos de Permiso')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Tipos de Permiso')


@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/permissiontype.js') }}"></script>
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
        <a class="nav-link" id="roles-tab"  href="{{route('roles.index')}}">Roles</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="permissions-tab"  href="{{route('permissions.index')}}">Permisos</a>
    </li>

    <li class="nav-item">
        <a class="nav-link active" id="permissionstype-tab" data-toggle="tab" href="#permissionstype" role="tab" aria-controls="permissiontype" aria-selected="true">Tipos de Permisos</a>
    </li>
</ul>

<div class="tab-pane fade show active" id="permissionstype-tab" role="tabpanel" aria-labelledby="permissionstype-tab">
    <div class="card">
        <div class="row">
            <div class="card-title col-6 mt-4 ml-4">
                <h3>Listado</h3>
            </div>
            <div class="col-5 mt-4 ml-4 text-right">
                <a href="{{ route('permission-types.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>             
            </div>
        </div>
        
        <div class="card-body"> 
            
            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif
            
           
        	<table class="table table-hover table-responsive-lg" id="list-pertypes">
        		<thead>
        			<tr>
        				<th>Nombre</th>
        				<th>Estado</th>
        				<th>Acción</th>
        			</tr>
        		</thead>
        		<tbody>
    				@foreach ($permissionTypes as $pType)
            			<tr>
            				<td><a  href="{{ route('permission-types.edit',['id' => $pType->id]) }}" class="text-primary">{{ $pType->name }}</a></td>
            				<td>
            					@if($pType->state == 1)
            						<span class="badge badge-success">Activa</span>
            					@else 
            						<span class="badge badge-danger">Inactiva</span>
            					@endif
            				</td>
            				<td>
            					<a class="btn btn-warning btn-flat " href="{{ route('permission-types.edit',['id' => $pType->id]) }}"><i class="i-Pen-2"></i> Editar</a>
            					<button class="btn btn-danger btn-flat  delete-btn" data-toggle="modal" data-target="#delete-modal" data-object="{{$pType}}" data-message="Está seguro que desea eliminar el tipo de permiso " data-component="Tipo de Permiso" data-component-name="{{ $pType->name }}" data-route="{{ route('permission-types.destroy',['id'=>$pType->id]) }}"><i class="i-File-Trash"></i> Eliminar</button>
            				</td>
            			</tr>
        			@endforeach
            		
        		</tbody>
        	</table>
        </div>
    </div>
</div>
@endsection
