@extends('layouts.backend')
@section('title','Tipos de Permiso')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')

<div class="card">
    <div class="row">
        <div class="card-title col-6 mt-4 ml-4">
            <h3>Listado</h3>
        </div>
        <div class="col-5 mt-4 ml-4 text-right">
            <a href="{{ route('permission-types.create') }}" class="btn btn-primary btn-sm"><i class="i-Add"></i> Crear</a>             
        </div>
    </div>
    
    <div class="card-body"> 
        
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-{{ session()->get('type') }}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif
        
        {{ $permissionTypes->links() }}
    	<table class="table table-hover table-responsive-lg">
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
        				<td><a  href="{{ route('permission-types.edit',['id' => $pType->id]) }}" class="text-primary">{{ $pType->name }}</a></td>
        				<td>
        					@if($pType->state == 1)
        						<span class="badge badge-success">Activa</span>
        					@else 
        						<span class="badge badge-danger">Inactiva</span>
        					@endif
        				</td>
        				<td>
        					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('permission-types.edit',['id' => $pType->id]) }}"><i class="i-Pen-2"></i> Editar</a>
        					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-component="Tipo de Permiso" data-component-name="{{ $pType->name }}" data-url="{{ route('permission-types.destroy',['id'=>$pType->id]) }}"><i class="i-File-Trash"></i> Eliminar</button>
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
        {{ $permissionTypes->links() }}
    </div>
</div>
@endsection
