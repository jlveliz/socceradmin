@extends('layouts.backend')

@section('title','Escritorio')

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