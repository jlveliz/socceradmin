@extends('layouts.backend')
@section('title','Temporadas')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/season.js') }}"></script>
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
            <a href="{{ route('seasons.create') }}" class="btn btn-primary "><i class="i-Add"></i> Crear</a>
        </div>
    </div>

    <div class="card-body"> 
        @if (session()->has('type') && session()->has('content'))
            <div class="alert alert-card alert-{{ session()->get('type') }}">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('content') }}
            </div>
        @endif

        {{-- validation errors --}}
        @if($errors->any())
            <div class="alert alert-card alert-danger sufee-alert alert with-close alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-hover table-responsive-lg" id="list-seasons">
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
        					<a class="btn btn-warning btn-flat " href="{{ route('seasons.edit',['id' => $season->id]) }}"><i class="i-Pen-2"></i> Editar</a>
        					<button class="btn btn-danger btn-flat  delete-btn" data-toggle="modal" data-target="#delete-modal"  data-object="{{$season}}" data-message="Está seguro de eliminar la temporada " data-route="{{ route('seasons.destroy',$season->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
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
    </div>
</div>
        
@endsection


