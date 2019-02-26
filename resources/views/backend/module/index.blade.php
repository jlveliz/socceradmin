@extends('layouts.backend')
@section('title','Módulos')
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
                        <a href="{{ route('modules.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $modules->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Nombre</th>
                				<th>Orden</th>
                				<th>Estado</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($modules) > 0)
	                			@foreach ($modules as $module)
	                			<tr>
                                    <td><a href="{{ route('modules.edit',['id' => $module->id]) }}" class="text-primary">{{ $module->name }}</a></td>
	                				<td>{{ $module->order }}</td>
	                				<td>
	                					@if($module->state == 1)
	                						<span class="badge badge-success">Activa</span>
	                					@else 
	                						<span class="badge badge-danger">Inactiva</span>
	                					@endif
	                				</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('modules.edit',['id' => $module->id]) }}"><i class="i-Pen-2"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$module}}" data-message="Está seguro de eliminar el Módulo" data-route="{{ route('modules.destroy',$module->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen módulos a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $modules->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
