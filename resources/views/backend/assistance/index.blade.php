@extends('layouts.backend')
@section('title','Asistencias')
@section('parent-page','Escritorio')
@section('route-parent',route('home'))
@section('current-page','Horarios')


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
            
            <div class="row justify-content-center">
                <h4 class="col-12 text-center text-uppercase text-info">{{ $currentSeason->name }} </h4> 
                <h6 class="col-12 text-center text-muted">{{$currentSeason->getFormatDuration()}}</h6>
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
                                            <label for="group-key">Grupo <span class="text-danger">*</span></label>
                                            
                                            <select id="group-key" class="form-control form-control-sm" name="group_id" @if(!isset($groups) || count($groups) == 0) disabled @endif>
                                                <option value="">Seleccione</option>
                                                @if (isset($groups))
                                                    @foreach ($groups as $grIdx => $group)
                                                        <option value="{{ $group->id }}" @if(request()->get('group_id') == $group->id) selected @endif> {{$group->coach->username}} - {{$group->range ? $group->range->name : '-'}} - {{$group->schedule['start'] .' '. $group->schedule['end']}}  </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('group_id'))
                                                <div class="invalid-feedback animated fadeInDown">{{ $errors->first('group_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-4">
                                        <div class="form-group {{ $errors->has('month') ? ' is-invalid' : '' }}">
                                            <label for="month">Mes <span class="text-danger">*</span></label>
                                            <select id="month" class="form-control form-control-sm" name="month" @if(!isset($months) || count($months) == 0) disabled @endif>
                                                <option value="">Seleccione</option>
                                                @if (isset($months))
                                                    @foreach ($months as $keyMonth => $month)
                                                        <option value="{{ $keyMonth }}" @if(request()->get('month') == $keyMonth) selected @endif>{{$month}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('month'))
                                                <div class="invalid-feedback animated fadeInDown">{{ $errors->first('month') }}</div>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="col-12 mb-2 text-center">
                                        <button class="btn btn-primary " @if(!request()->has('field') || !request()->has('key_day') || !request()->has('group_id')) disabled @endif><i class="i-Data-Search"></i> Buscar</button>
                                    </div>
                                    
                                </div>
                            </form>
                       </div>
                   </div>

                </div>
                
            </div>
            <div class="row mt-2 justify-content-center">
                <div class="col-11">
                    @if(isset($assistances) && count($assistances) > 0) 
                        <table class="table table-bordered ">
                            <thead class="text-center">
                                <tr>
                                    <th>F. de Inscripción</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Representante</th>
                                    <th>I</th>
                                    <th>M</th>
                                    <th>C</th>
                                    @for($i = 0; $i < count($assistances['dates']); $i++)
                                    <th>{{$assistances['dates'][$i]->format('d')}}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <form action="{{ route('assistances.store') }}" method="POST">
                                {{ csrf_field() }}
                                <tbody>
                                    @if (count($assistances['assistances']) > 0)
                                        @foreach ($assistances['assistances']  as $key =>  $assistance)
                                            <tr>
                                                <td>{{ $assistance->date_inscription }}</td>
                                                <td>{{ $assistance->student_name }}</td>
                                                <td>{{ $assistance->age }}</td>
                                                <td>{{ $assistance->representant }}</td>
                                                <td>{{ $assistance->is_pay_inscription == '1' ? 'Si' : 'No' }}</td>
                                                <td>{{ $assistance->is_pay_first_month == '1' ? 'Si' : 'No' }}</td>
                                                <td>{{ $assistance->is_delivered_uniform == '1' ? 'Si' : 'No' }}</td>
                                                @for ($i = 0; $i < count($assistances['dates']); $i++)
                                                    @php $idAssistance = 'id_'.$i; @endphp
                                                    @php $commentAssistance = 'comment_'.$i; @endphp
                                                    <td class="text-center">
                                                        <div class="form-check form-check-inline">
                                                            <input type="hidden" value="{{$assistance->$commentAssistance}}" class="comment-hidden" name="assistances[{{$key}}][{{$i}}][comment]"/>
                                                            <input type="hidden" value="{{$assistance->$idAssistance}}" name="assistances[{{$key}}][{{$i}}][assistance_id]" id="check-assistance-{{$key}}-{{$i}}" />
                                                            <input class="form-check-input check-assistance" name="assistances[{{$key}}][{{$i}}][value]" type="checkbox" id="{{str_slug($assistance->student_name)}}-{{$i}}"  @if($assistance->$i == 1) checked @endif  @if($assistance->$commentAssistance) title="{{$assistance->$commentAssistance}}" data-toggle="tooltip" @endif/>
                                                            <a data-toggle='modal' data-target='#insertCommentModal' class="show-message @if($assistance->$commentAssistance) visible @else invisible @endif"><i class="i-Speach-Bubble-2"></i></a>
                                                        </div>
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ (7  + count($assistances['dates'])) }}"><p class="text-center align-middle">No existen datos</p></td>
                                        </tr>
                                    @endif
                                </tbody>
                                @if (count($assistances['assistances']) > 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="{{ (7  + count($assistances['dates']) ) }}" class="text-center">
                                            <button type="submit" class="btn btn-primary "><i class="i-Data-Save"></i> Procesar</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                            @endif
                        </table>
                    @else
                        <p class="text-center mt-2">Seleccione cada uno de los filtros para continuar</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@include('backend.assistance.includes.insert-comment')
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/components/assistance.js') }}"></script>   
@endsection
