@extends('layouts.backend')
@section('title','Rangos de Edad')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Rangos de Edad')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/agerange.js') }}"></script>
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
        <a class="nav-link" id="range-age-tab"  href="{{route('ftypes.index')}}">Tipos de Cancha</a>
    </li>


    <li class="nav-item">
        <a class="nav-link active" id="range-age-tab" data-toggle="tab" href="#ageranges" role="tab" aria-controls="ageranges" aria-selected="true">Rango de Edades</a>
    </li>
</ul>
<div class="card">

    <div class="row">
        <div class="card-title col-6 mt-4 ml-4">
            <h3>Listado</h3>
        </div>
        <div class="col-5 mt-4 ml-4 text-right">
            <a href="{{ route('ageranges.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>             
        </div>
    </div>

    <div class="card-body"> 
        
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-card alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif

        
    	<table class="table table-hover table-responsive-lg" id="list-ageranges">
    		<thead>
    			<tr>
                    <th>Nombre</th>
    				<th>Edades</th>
    				<th>Acción</th>
    			</tr>
    		</thead>
    		<tbody>
				@foreach ($ageRanges as $range)
    			<tr>
                    <td><a href="{{ route('ageranges.edit',['id' => $range->id]) }}" class="text-primary">{{ $range->name }}</a></td>
    				<td>{{ $range->min_age }} - {{$range->max_age}} Años</td>
    				<td>
    					<a class="btn btn-warning btn-flat " href="{{ route('ageranges.edit',['id' => $range->id]) }}"><i class="i-Pen-2"></i> Editar</a>
    					<button class="btn btn-danger btn-flat  delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$range}}" data-message="Está seguro de eliminar el Rango" data-route="{{ route('ageranges.destroy',$range->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
        
    </div>
</div>
@endsection
