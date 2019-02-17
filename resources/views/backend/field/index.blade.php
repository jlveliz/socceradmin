@extends('layouts.backend')
@section('title','Canchas')
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
                    <a class="nav-link active" id="field-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="field" aria-selected="true">Canchas</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="range-age-tab"  href="{{route('ftypes.index')}}">Tipos de Cancha</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="range-age-tab"  href="{{route('ageranges.index')}}">Rango de Edades</a>
                </li>
            </ul>

            <div class="card p-30">
                <div class="tab-content" id="mytabcontent">
                    <div class="tab-pane fade show active" id="fields" role="tabpanel" aria-labelledby="field-tab">
                        <div class="row">
                            <div class="card-title col-6">
                                <h3>Listado</h3>
                            </div>
                            <div class="col-6 text-right">
                               <a href="{{ route('fields.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Crear</a><br>           
                            </div>
                            <div class="card-body"> 
        
                                @if (session()->has('type') && session()->has('content'))
                                    <div class="alert alert-{{ session()->get('type') }}">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        {{ session()->get('content') }}
                                    </div>
                                @endif
        
                                {{$fields->links()}}
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Tipo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($fields) > 0)
                                            @foreach ($fields as $field)
                                            <tr>
                                                <td><a href="{{ route('fields.edit',['id' => $field->id]) }}" class="text-primary">{{ $field->name }}</a></td>
                                                <td>{{ $field->address}}</td>
                                                <td>{{ $field->type ? $field->type->name : '-' }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-flat btn-sm" href="{{ route('fields.edit',['id' => $field->id]) }}"><i class="fa fa-edit"></i> Editar</a>
                                                    <button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-object="{{$field}}" data-message="Está seguro de eliminar la cancha " data-route="{{ route('fields.destroy',$field->id) }}"><i class="fa fa-trash"></i> Eliminar</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="4">
                                                    <p class="text-primary">No existen Canchas a consultar</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{$fields->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection
