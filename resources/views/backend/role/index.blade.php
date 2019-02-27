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
<div class="card">
    <div class="row">
        <div class="card-title col-6 mt-4 ml-4">
            <h3>Listado</h3>
        </div>
        <div class="col-5 mt-4 ml-4 text-right">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm"><i class="i-Add"></i> Crear</a>             
        </div>
    </div>

    <div class="card-body"> 
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-{{ session()->get('type') }}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
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
    					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('roles.edit',['id' => $role->id]) }}"><i class="i-Pen-2"></i> Editar</a>
    					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$role}}" data-message="Está seguro de eliminar el Rol" data-route="{{ route('roles.destroy',$role->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    </div>
</div>
@endsection
