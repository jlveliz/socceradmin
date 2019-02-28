@extends('layouts.backend')
@section('parent-page','Escritorio')
@section('title','Escritorio')
@section('route-parent',route('home'))

@section('content')


<div class="row">
    <div class="col-lg-8 col-md-12">
        @include('backend.dashboard.schedule')        
    </div>
</div>
<!-- End PAge Content -->

@endsection


@section('js')
<script type="text/javascript" src="{{ asset('js/components/assistance.js') }}"></script>   
@endsection
