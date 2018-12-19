@extends('layouts.backend')
@section('title','Permisos')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12 ">
            <div class="card p-30">
                <div class="row">
                    <div class="card-title col-6">
                        <h3>Listado</h3>
                    </div>
                    <div class="col-6 text-right">
                       <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>           
                    </div>
                    <div class="card-body"> 

                        @if (session()->has('type') && session()->has('content'))
                            <div class="alert alert-{{ session()->get('type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session()->get('content') }}
                            </div>
                        @endif

                        {{$permissions->links()}}
                    	<table class="table table-hover">
                    		<thead>
                    			<tr>
                                    <th>Nombre</th>
                                    <th>Módulo</th>
                                    <th>Tipo</th>
                    				<th>Acción</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@if (count($permissions) > 0)
    	                			@foreach ($permissions as $permission)
    	                			<tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->module->name }}</td>
    	                				<td>{{ $permission->type->name }}</td>
    	                				<td>
    	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('permissions.edit',['id' => $permission->id]) }}"><i class="fa fa-edit"></i> Editar</a>
    	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-object="{{$permission}}" data-message="Está seguro de eliminar el Permiso" data-route="{{ route('permissions.destroy',$permission->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
    	                				</td>
    	                			</tr>
    	                			@endforeach
    	                		@else
    	                			<tr>
    	                				<td class="text-center" colspan="4">
    	                					<p class="text-primary">No existen Permisos a consultar</p>
    	                				</td>
    	                			</tr>
                    			@endif
                    		</tbody>
                    	</table>
                        {{$permissions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
