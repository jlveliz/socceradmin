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
                                                <div class="col-lg-3 col-4">
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
                                                <div class="col-lg-2 col-4">
                                                    <div class="form-group {{ $errors->has('field_id') ? ' is-invalid' : '' }}">
                                                        <label for="name">Día <span class="text-danger">*</span></label>
                                                        
                                                        <select id="key-day" class="form-control form-control-sm" name="key_day" @if(!isset($days) || count($days) == 0) disabled @endif>
                                                            <option value="">Seleccione</option>
                                                            @if (isset($days))
                                                                @foreach ($days as $keyDay => $day)
                                                                    <option value="{{ $keyDay }}" @if(old('key_day') == $keyDay || request()->get('key_day') == $keyDay) selected @endif>{{days_of_week()[$keyDay]}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('key_day'))
                                                            <div class="invalid-feedback animated fadeInDown">{{ $errors->first('key_day') }}</div>
                                                        @endif
                                                    </div>

                                                </div>

                                                <div class="col-lg-5 col-4">
                                                    <div class="form-group {{ $errors->has('field_id') ? ' is-invalid' : '' }}">
                                                        <label for="name">Grupo <span class="text-danger">*</span></label>
                                                        
                                                        <select id="group-key" class="form-control form-control-sm" name="group_id" @if(!isset($groups) || count($groups) == 0) disabled @endif>
                                                            <option value="">Seleccione</option>
                                                            @if (isset($groups))
                                                                @foreach ($groups as $keyDay => $group)
                                                                    <option value="{{ $group->id }}">{{$group->schedule['start'] .' '. $group->schedule['end']}} - {{get_group_names()[$group->name]}} -  {{$group->range ? $group->range->name : '-'}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('group_id'))
                                                            <div class="invalid-feedback animated fadeInDown">{{ $errors->first('group_id') }}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-4 mt-4">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar</button>
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
