@extends('layouts.backend')
@section('title','Tipos de Persona')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/ptype.js') }}"></script>
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
            <a href="{{ route('ptypes.create') }}" class="btn btn-primary btn-sm"><i class="i-Add"></i> Crear</a>             
        </div>
    </div>
    <div class="card-body"> 
        
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif

        <table class="table table-hover table-responsive-lg" id="list-ptypes">
    		<thead>
    			<tr>
                    <th>Nombre</th>
    				<th>Código</th>
    				<th>Estado</th>
    				<th>Acción</th>
    			</tr>
    		</thead>
    		<tbody>
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
    					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('ptypes.edit',['id' => $ptype->id]) }}"><i class="i-Pen-2"></i> Editar</a>
    					<button class="btn btn-danger btn-flat btn-sm delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$ptype}}" data-message="Está seguro de eliminar el Tipo de " data-route="{{ route('ptypes.destroy',$ptype->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    </div>
</div>
@endsection