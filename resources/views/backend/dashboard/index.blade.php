@extends('layouts.backend')
@section('parent-page','Escritorio')
@section('title','Escritorio')
@section('route-parent',route('home'))

@section('content')


<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="row">
            {{-- estudiantes inscritos --}}
            <div class="col-lg-4 col-md-6 col-sm-6">
            	<div class="card card-icon mb-4">
            		<div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <p class="text-muted mt-2 mb-1">Soccers Inscritos</p>
                        <p class="text-primary text-24 line-height-1 mb-0">{{ $totalStudents[0]->total_students }}</p>
                        
                    </div>
                </div>
            </div>

        	{{-- Temporada --}}
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <i class="i-Clock"></i>
                        <p class="text-muted mt-2 mb-2">Temporada</p>
                        <p class="text-primary text-21 line-height-1 mb-0"><small>{{ $currentSeason->name }}</small></p>
                    </div>
                </div>
            </div>

            {{-- canchas --}}
            <div class="col-lg-4 col-md-6 col-sm-6">
            	<div class="card card-icon mb-4">
            		<div class="card-body text-center">
                        <i class="i-Christmas-Ball"></i>
                        <p class="text-muted mt-2 mb-0">Canchas Activas</p>
                        <p class="text-primary text-22 line-height-1 mb-2"><small>{{ $totalFields[0]->count_fields }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title m-0 pb-2">Asistencia en Canchas</h5>
                @foreach ($fields as $field)
                    <button class="btn btn-primary btn-open-modal-assistance-field" data-field="{{ $field->id }}" data-toggle="modal" data-target="#assistance-modal"> {{ $field->name }} </button>
                @endforeach
            </div>
        </div>
    </div>

</div>
<!-- End PAge Content -->

@include('backend.dashboard.assistance-modal')

@endsection


@section('js')
<script type="text/javascript" src="{{ asset('js/components/dashboard.js') }}"></script>   
@endsection
