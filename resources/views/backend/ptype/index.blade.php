@extends('layouts.backend')
@section('title','Tipos de Persona')
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
                        <a href="{{ route('ptypes.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $personTypes->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Nombre</th>
                				<th>Código</th>
                				<th>Estado</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($personTypes) > 0)
	                			@foreach ($personTypes as $ptype)
	                			<tr>
                                    <td><a href="{{ route('ptypes.edit',['id' => $ptype->id]) }}" class="text-primary">{{ $ptype->name }}</a></td>
	                				<td>{{ $ptype->code }}</td>
	                				<td>
	                					@if($ptype->state == 1)
	                						<span class="badge badge-success">Activa</span>
	                					@else 
	                						<span class="badge badge-danger">Inactiva</span>
	                					@endif
	                				</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('ptypes.edit',['id' => $ptype->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$ptype}}" data-message="Está seguro de eliminar el Tipo de " data-route="{{ route('ptypes.destroy',$ptype->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen Tipos de Persona a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $personTypes->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection