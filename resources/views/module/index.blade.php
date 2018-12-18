@extends('layouts.app')

@section('title','Módulos')

@section('parent-page','Inicio')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card p-30">
			<div class="row">
				<div class="card-title col-6">
					<h3>Listado</h3>
				</div>
				<div class="col-6 text-right">
					<a href="{{ route('modules.create') }}" class="btn btn-primary btn-sm">Crear</a>				
				</div>
			</div>
			<div class="card-body">
				@if (session()->has('mensaje'))
					<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
						{{ session()->get('mensaje') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
				@endif
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Fecha Creación/ Edición</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tbody>
							@if (count($modules) > 0)
								@foreach ($modules as $module)
									<tr>
										<td>{{$module->name}}</td>
										<td>{{$module->created_at->toDateString()}} / {{$module->updated_at->toDateString()}}</td>
										<td>
											<a class="btn btn-primary btn-sm" href="{{ route('modules.edit',$module->id) }}">Editar</a>
											<a class="btn btn-danger btn-sm delete-item text-light" data-object="{{$module}}" data-message="Está seguro de eliminar el Módulo" data-route="{{ route('modules.destroy',$module->id) }}">Eliminar</a>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3"><p class="text-center text-muted">No existen datos para mostrar</p></td>
								</tr>
							@endif
						</tbody>
					</table>
					@if (count($modules) > 0)
						{{$modules->links()}}
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@endsection