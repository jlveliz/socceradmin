@extends('layouts.backend')
@section('parent-page','Escritorio')
@section('title','Escritorio')
@section('route-parent',route('home'))

@section('content')

<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            	
                   {{session('color')}}  
                <div class="card-body"> Hola {{ Auth::user()->email }}. </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
@endsection