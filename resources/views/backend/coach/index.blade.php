@extends('layouts.backend')
@section('title','Coachs')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Coachs')

@section('js')
<script type="text/javascript" src="{{ asset('js/data-table/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/components/coach.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/data-table/datatables.min.css') }}">
@endsection

@section('content')

<ul class="nav nav-tabs customtab mb-2">
    <li class="nav-item">
        <a class="nav-link active" id="field-tab" data-toggle="tab" href="#coachs" role="tab" aria-controls="coach" aria-selected="true">Coachs</a>
    </li>
</ul>

<div class="card">
    
    <div class="tab-pane fade show active" id="coachs" role="tabpanel" aria-labelledby="coach-tab">
        <div class="row">
            <div class="card-title col-6 mt-4 ml-4">
                <h3>Listado</h3>
            </div>
        </div>

        <div class="card-body"> 
            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif

            {{-- validation errors --}}
            @if($errors->any())
                <div class="alert alert-danger sufee-alert alert with-close alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-hover table-responsive-lg" id="list-coachs">
        		<thead>
        			<tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
        				<th>Último Acceso</th>
        			</tr>
        		</thead>
        		<tbody>
    				@foreach ($coachs as $coach)
        			<tr>
                        <td><a href="#" class="text-primary">{{ $coach->username }}</a></td>
                        <td>{{$coach->person->name .' '. $coach->person->last_name}}</td>
        				<td>
                            @if ($coach->last_access)
                                {{ $coach->last_access }}
                            @else
                                -
                            @endif
                        </td>
        			</tr>
        			@endforeach
            		
        		</tbody>
        	</table>
        </div>
    </div>

</div>
@endsection
