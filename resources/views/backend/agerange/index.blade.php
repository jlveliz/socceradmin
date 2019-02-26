@extends('layouts.backend')
@section('title','Rangos de Edad')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
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
            <div class="card p-30">

                <div class="row">
                    <div class="card-title col-6">
                        <h3>Listado</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('ageranges.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</a>             
                    </div>
                </div>

                <div class="card-body"> 
                    
                    @if (session()->has('type') && session()->has('content'))
                        <div class="alert alert-{{ session()->get('type') }} sufee-alert alert with-close alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ session()->get('content') }}
                        </div>
                    @endif

                    {{ $ageRanges->links() }}
                	<table class="table table-hover">
                		<thead>
                			<tr>
                                <th>Nombre</th>
                				<th>Edades</th>
                				<th>Acción</th>
                			</tr>
                		</thead>
                		<tbody>
                			@if (count($ageRanges) > 0)
	                			@foreach ($ageRanges as $range)
	                			<tr>
                                    <td><a href="{{ route('ageranges.edit',['id' => $range->id]) }}" class="text-primary">{{ $range->name }}</a></td>
	                				<td>{{ $range->min_age }} - {{$range->max_age}} Años</td>
	                				<td>
	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('ageranges.edit',['id' => $range->id]) }}"><i class="i-Pen-2"></i> Editar</a>
	                					<button class="btn btn-danger btn-flat btn-sm delete-btn text-light" data-toggle="modal" data-target="#delete-modal" data-object="{{$range}}" data-message="Está seguro de eliminar el Rango" data-route="{{ route('ageranges.destroy',$range->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
	                				</td>
	                			</tr>
	                			@endforeach
	                		@else
	                			<tr>
	                				<td class="text-center" colspan="4">
	                					<p class="text-primary">No existen Rangos de Edad a consultar</p>
	                				</td>
	                			</tr>
                			@endif
                		</tbody>
                	</table>
                    {{ $ageRanges->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
