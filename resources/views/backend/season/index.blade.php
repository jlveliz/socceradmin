@extends('layouts.backend')
@section('title','Temporadas')
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
                        <a href="{{ route('seasons.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>
                    </div>
                </div>

                <div class="card-body"> 
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $seasons->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Nombre</th>
                				<th>Duración</th>
                				<th>Estado</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($seasons) > 0)
	                			@foreach ($seasons as $season)
	                			<tr>
                                    <td><a href="{{ route('seasons.edit',['id' => $season->id]) }}" class="text-primary">{{ $season->name }}</a></td>
                                    <td>{{ $season->getFormatDuration()}}</td>
                                    <td>@if($season->state == 1) <span class="badge badge-success">Activo</span>  @else <span class="badge badge-warning">Inactivo</span>      @endif</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('seasons.edit',['id' => $season->id]) }}"><i class="fa fa-edit"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$season}}" data-message="Está seguro de eliminar la temporada " data-route="{{ route('seasons.destroy',$season->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen temporadas a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $seasons->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection