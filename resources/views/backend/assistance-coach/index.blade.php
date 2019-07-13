@extends('layouts.backend')
@section('title','Asistencias de Coachs')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Asistencias de Coachs')


@section('content')


<!-- Container fluid  -->
<div class="card">

    <div class="row">
        <div class="card-body"> 
            
            @if (session()->has('type') && session()->has('content'))
                <div class="alert alert-card alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif


            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach

            <div class="row mt-2">
                @foreach ($fields as $field)
                    <div class="col-6 col-xs-12 assistance-coach">
                        <h3 class="text-center">{{ $field->name }}</h3>
                        <div class="form-group col-12 col-lg-4">
                            <label for="">Mes</label>
                            <select name="select-coach-month" id="" class="select-coach-month form-control">
                                @foreach (month_of_year() as $key => $month)
                                <option value="{{ $key }}" @if ($key == date('m')) selected @endif>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h6 class="text-center"><b>{{ $field->getFormatDays() }}</b></h6>
                        <div class="table-responsive">
                            <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Día</th>
                                            <th>Fecha</th>
                                            @php
                                                $coachs = (new Futbol\Models\Coach())->getCoachsByField($field->id);
                                                $idCoachs = [];
                                            @endphp
                                            @foreach ($coachs  as $coach)
                                            <th class="coach-name" data-coach="{{$coach->id}}">{{ $coach->person->name }}</th>
                                                @php
                                                    $idCoachs[] = $coach->id;
                                                @endphp
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="table-coach-body" data-field="{{ $field->id }}" data-coachs="{{ count($coachs) }}" data-idcoachs="{{json_encode($idCoachs)}}">
                                        <tr>
                                            <td colspan="{{ count($coachs) + 2 }}">
                                                <div class='col-12 text-center loader-modal-container'><div class='loader-bubble loader-bubble-primary'></div></div>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('backend.assistance-coach.insert-edit-assistance')

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/components/assistance-coach.js') }}"></script>
@endsection

