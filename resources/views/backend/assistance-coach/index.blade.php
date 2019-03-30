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
                <div class="alert alert-{{ session()->get('type') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ session()->get('content') }}
                </div>
            @endif

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
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>Días</th>
                                            @php
                                                $coachs = (new HappyFeet\Models\Coach())->getCoachsByField($field->id);
                                            @endphp
                                            @foreach ($coachs  as $coach)
                                            <th>{{ $coach->person->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="table-coach-body" data-field="{{ $field->id }}" data-coachs="{{ count($coachs) }}">
                                        <tr>
                                            <td colspan="{{ count($coachs) + 1 }}">
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
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/components/assistance-coach.js') }}"></script>
@endsection

