@extends('layouts.backend')
@section('title','Tipos de Cancha')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Tipos de Cancha')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/ftype.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/data-table/datatables.min.css') }}">
@endsection

@section('content')
<ul class="nav nav-tabs customtab mb-2">
    <li class="nav-item">
        <a class="nav-link" id="field-tab" href="{{route('fields.index')}}">Canchas</a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link active"  id="range-age-tab"  data-toggle="tab" href="#ageranges" role="tab" aria-controls="ageranges" aria-selected="true"> Tipos de Cancha</a>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="range-age-tab" href="{{route('ageranges.index')}}">Rango de Edades</a>
    </li>
</ul>

<div class="car">

    <div class="row">
        <div class="card-title col-6 mt-4 ml-4">
            <h3>Listado</h3>
        </div>
        <div class="col-5 mt-4 ml-4 text-right">
            <a href="{{ route('ftypes.create') }}" class="btn btn-primary btn-sm"><i class="i-Add"></i> Crear</a>             
        </div>
    </div>

    <div class="card-body">
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif

        {{-- validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-hover table-responsive-lg" id="list-ftypes">
    		<thead>
    			<tr>
                    <th>Nombre</th>
    				<th>Acción</th>
    			</tr>
    		</thead>
    		<tbody>
				@foreach ($fieldTypes as $ftype)
    			<tr>
                    <td><a href="{{ route('ftypes.edit',['id' => $ftype->id]) }}" class="text-primary">{{ $ftype->name }}</a></td>
    				<td>
    					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('ftypes.edit',['id' => $ftype->id]) }}"><i class="i-Pen-2"></i> Editar</a>
    					<button class="btn btn-danger btn-flat btn-sm delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$ftype}}" data-message="Está seguro de eliminar el Tipo de " data-route="{{ route('ftypes.destroy',$ftype->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    </div>
</div>
@endsection