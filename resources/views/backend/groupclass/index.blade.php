@extends('layouts.backend')
@section('title','Grupos De Clases')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12 ">
            <div class="card p-30">
                <div class="row">
                    <div class="card-title col-6">
                        <h3>Listado</h3>
                    </div>
                    <div class="col-6 text-right">
                       <a href="{{ route('groupclass.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>           
                    </div>
                    <div class="card-body"> 

                        @if (session()->has('type') && session()->has('content'))
                            <div class="alert alert-{{ session()->get('type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session()->get('content') }}
                            </div>
                        @endif

                        {{$groups->links()}}
                    	<table class="table table-hover">
                    		<thead>
                    			<tr>
                                    <th>Grupo</th>
                                    <th>Cancha</th>
                                    <th>Instructor</th>
                    				<th>Acción</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			@if (count($groups) > 0)
    	                			@foreach ($groups as $group)
    	                			<tr>
                                        <td><a href="{{ route('groupclass.edit',['id' => $group->id]) }}" class="text-primary">{{ $group->name }}</a></td>
                                        <td>{{ $field->field->name}}</td>
                                        <td>-</td>
    	                				<td>
    	                					<a class="btn btn-warning btn-flat btn-sm" href="{{ route('groupclass.edit',['id' => $group->id]) }}"><i class="fa fa-edit"></i> Editar</a>
    	                					<button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-object="{{$group}}" data-message="Está seguro de eliminar la cancha " data-route="{{ route('groupclass.destroy',$group->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
    	                				</td>
    	                			</tr>
    	                			@endforeach
    	                		@else
    	                			<tr>
    	                				<td class="text-center" colspan="4">
    	                					<p class="text-primary">No existen Grupos a consultar</p>
    	                				</td>
    	                			</tr>
                    			@endif
                    		</tbody>
                    	</table>
                        {{$groups->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
