@extends('layouts.backend')
@section('title','Permisos')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/permission.js') }}"></script>
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
           <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm pull-right"><i class="i-Add"></i> Crear</a><br>           
        </div>
    </div>
        <div class="card-body"> 

            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif

            <table class="table table-hover table-responsive-lg" id="list-permissions">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Padre</th>
                        <th>Módulo</th>
                        <th>Tipo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td><a href="{{ route('permissions.edit',['id' => $permission->id]) }}" class="text-primary">{{ $permission->name }}</a></td>
                        <td>{{ $permission->parent ?  $permission->parent->name : '-' }}</td>
                        <td>{{ $permission->module->name }}</td>
                        <td>{{ $permission->type->name }}</td>
                        <td>
                            <a class="btn btn-warning btn-flat btn-sm" href="{{ route('permissions.edit',['id' => $permission->id]) }}"><i class="i-Pen-2"></i> Editar</a>
                            <button class="btn btn-danger btn-flat btn-sm delete-btn" data-toggle="modal" data-target="#delete-modal" data-object="{{$permission}}" data-message="Está seguro de eliminar el Permiso" data-route="{{ route('permissions.destroy',$permission->id) }}"><i class="i-File-Trash"></i> Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
<!-- End PAge Content -->
@endsection
