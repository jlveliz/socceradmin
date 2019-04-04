@extends('layouts.backend')
@section('title','Módulos')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Módulos')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/module.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/data-table/datatables.min.css') }}">
@endsection


@section('content')
<!-- Container fluid  -->
<div class="card">

    <div class="row">
        <div class="card-title col-6 mt-4 ml-4">
            <h3>Listado</h3>
        </div>
        <div class="col-5 mt-4 ml-4 text-right">
            <a href="{{ route('modules.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>             
        </div>
    </div>

    <div class="card-body"> 
        
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif

        {{-- validation errors --}}
        @if($errors->any())
            <div class="alert alert-card alert-danger sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li><br>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-hover table-responsive-lg" id="list-modules">
    		<thead>
    			<tr>
                    <th>Nombre</th>
    				<th>Orden</th>
    				<th>Estado</th>
    				<th>Acción</th>
    			</tr>
    		</thead>
    		<tbody>
				@foreach ($modules as $module)
    			<tr>
                    <td><a href="{{ route('modules.edit',['id' => $module->id]) }}" class="text-primary">{{ $module->name }}</a></td>
    				<td>{{ $module->order }}</td>
    				<td>
    					@if($module->state == 1)
    						<p><span class="badge badge-success">Activa</span></p>
    					@else 
    						<p><span class="badge badge-danger">Inactiva</span></p>
    					@endif
    				</td>
    				<td>
    					<a class="btn btn-warning btn-flat " href="{{ route('modules.edit',['id' => $module->id]) }}"><i class="i-Pen-2"></i> Editar</a>
    					<button class="btn btn-danger btn-flat  delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$module}}" data-message="Está seguro de eliminar el Módulo" data-route="{{ route('modules.destroy',$module->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
    				</td>
    			</tr>
    			@endforeach
        		
    		</tbody>
    	</table>
    </div>
</div>
@endsection
