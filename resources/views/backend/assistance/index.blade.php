@extends('layouts.backend')
@section('title','Asistencias')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))

@section('content')


<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="row">
                    <div class="card-body"> 
                        
                        @if (session()->has('type') && session()->has('content'))
                            <div class="alert alert-{{ session()->get('type') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session()->get('content') }}
                            </div>
                        @endif
                        
                        <div class="row justify-content-center">
                            <div class="col-11 ">
                               <div class="card border-none border-warning p-0 m-0">
                                    <div class="card-header">Filtros</div>
                                    <div class="card-body pt-2 px-2">
                                        <form id="filter-assistance" action="{{ route('assistances.index') }}" method="GET">
                                            <div class="row">
                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group {{ $errors->has('field_id') ? ' is-invalid' : '' }}">
                                                        <label for="name">Cancha <span class="text-danger">*</span></label>
                                                        <select name="field" id="field-id" class="form-control form-control-sm" name="field_id">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($fields as $field)
                                                                <option value="{{ $field->id }}" @if( old('field') == $field->id || request()->get('field') == $field->id) selected @endif>{{ $field->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('field'))
                                                            <div class="invalid-feedback animated fadeInDown">{{ $errors->first('field') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group {{ $errors->has('field_id') ? ' is-invalid' : '' }}">
                                                        <label for="name">Día <span class="text-danger">*</span></label>
                                                        
                                                        <select id="key-day" class="form-control form-control-sm" name="key_day" @if(!isset($groups) || count($groups) == 0) disabled @endif>
                                                            @if (isset($groups))
                                                                @foreach ($groups as $group)
                                                                    <option value="{{ $group->id }}">{{days_of_week()[$group->day]}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('group_id'))
                                                            <div class="invalid-feedback animated fadeInDown">{{ $errors->first('group_id') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                   </div>
                               </div>

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

@section('js')
<script type="text/javascript" src="{{ asset('js/components/assistance.js') }}"></script>   
@endsection
