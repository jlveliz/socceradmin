@foreach ($availableDays as $kday => $day)
    <div class="card p-0">
        <div class="card-header p-0" id="headingOne">
            <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ucwords($kday)}}" aria-expanded="true" aria-controls="collapse{{ucwords($kday)}}">
                {{days_of_week()[$kday]}}
            </button>
            </h2>
        </div>
														
        <div id="collapse{{ucwords($kday)}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body p-2">
                @foreach ($day as $kSchedule => $schedule)
                <p><i class="fa fa-circle f-4 text-warning"></i> Horario de <strong>{{$schedule['start']}}</strong> hasta las <strong>{{$schedule['end']}}</strong></p>   
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rango</th>
                            <th>Capacidad</th>
                            <th colspan="2">Hora Inicio / Hora Fin</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <pre>
                            @php var_dump($field->groups) @endphp
                        </pre> --}}
                        @if (count($field->groups) > 0) 
                            @php $groupNum = 0; @endphp
                            {{--  --}}
                            @foreach ($field->groups as $groupDb)
                                {{-- verify shedule key --}}
                                @if($groupDb->schedule_field_parent == $kSchedule && $groupDb->day == $kday)
                                    <tr id="{{$kday}}-group-schedule-{{$kSchedule}}-{{$groupNum}}">
                                        <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][id]" value="{{$groupDb->id}}" class="group-id">
                                        <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][field_id]" value="{{$field->id}}" class="field-name">
                                        <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][day]" value="{{$kday}}" class="day-name">
                                        <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule_field_parent]" value="{{$kSchedule}}" class="schedule-key-name">
                                        <td>
                                            <select name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][name]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][name]" class="form-control form-control-sm group-name @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.name')) is-invalid @endif">
                                                @foreach (get_group_names() as $grkey => $gr)
                                                <option value="{{$grkey}}" @if($groupDb->name == $grkey) selected @endif>{{$gr}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.name'))
												<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.name') }}</div>
											@endif
                                        </td>
                                        <td>
                                            <select name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][range_age_id]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][range_age_id]" class="form-control form-control-sm range-name @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.range_age_id')) is-invalid @endif">
                                                @foreach ($aRanges as  $range)
                                                <option value="{{$range->id}}">{{$range->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.range_age_id'))
												<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.range_age_id') }}</div>
											@endif
                                        </td>
                                        <td>
                                            <input type="number" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][maximum_capacity]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][maximum_capacity]" class="form-control form-control-sm capacity" max="{{config('happyfeet.group-max-num')}}" min="1" value="{{$groupDb->maximum_capacity}}">
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.maximum_capacity'))
												<div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.maximum_capacity') }}</div>
											@endif
                                        </td>
                                        <td>
                                            <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule][start]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule][start]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm start-hour" value="{{$groupDb->schedule['start']}}">
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.schedule.start'))
                                                <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.schedule.start') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule][end]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule][end]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm end-hour" value="{{$groupDb->schedule['end']}}">
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.schedule.end'))
                                                <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.schedule.end') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <select name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][state]" id="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][state]" class="form-control form-control-sm group-state">
                                                @foreach (get_states() as $kstate => $state)
                                                <option value="{{$kstate}}" @if($kstate == $groupDb->state) selected @endif>{{$state}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.state'))
                                                <div id="val-state-error" class="invalid-feedback animated fadeInDown">{{ $errors->first('groups.'.$kday.'.'.$kSchedule.'.'.$groupNum.'.state') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-link btn-sm add-group-schedule"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @elseif(old('groups') != null)
                                <h2>hola 2</h2>
                            <tr id="{{$kday}}-group-schedule-{{$kSchedule}}-0">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][field_id]" value="{{$field->id}}" class="field-name">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][day]" value="{{$kday}}" class="day-name">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][{{$groupNum}}][schedule_field_parent]" value="{{$kSchedule}}" class="schedule-key-name">
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][name]" id="groups[{{$kday}}][{{$kSchedule}}][0][name]" class="form-control form-control-sm group-name">
                                        @foreach (get_group_names() as $grkey => $gr)
                                        <option value="{{$grkey}}">{{$gr}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][range_age_id]" id="groups[{{$kday}}][{{$kSchedule}}][0][range_age_id]" class="form-control form-control-sm range-name">
                                        @foreach ($aRanges as  $range)
                                        <option value="{{$range->id}}">{{$range->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="groups[{{$kday}}][{{$kSchedule}}][0][maximum_capacity]" id="groups[{{$kday}}][{{$kSchedule}}][0][maximum_capacity]" class="form-control form-control-sm capacity" max="{{config('happyfeet.group-max-num')}}" min="1">
                                </td>
                                <td>
                                    <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][0][schedule][start]" id="groups[{{$kday}}][{{$kSchedule}}][0][schedule][start]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm start-hour">
                                </td>
                                <td>
                                    <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][0][schedule][end]" id="groups[{{$kday}}][{{$kSchedule}}][0][schedule][end]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm end-hour">
                                </td>
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][state]" id="groups[{{$kday}}][{{$kSchedule}}][0][state]" class="form-control form-control-sm group-state">
                                        @foreach (get_states() as $kstate => $state)
                                        <option value="{{$kstate}}">{{$state}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm add-group-schedule"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        @else
                            <h3>Hola 3</h3>
                            <tr id="{{$kday}}-group-schedule-{{$kSchedule}}-0">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][0][field_id]" value="{{$field->id}}" class="field-name">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][0][day]" value="{{$kday}}" class="day-name">
                                    <input type="hidden" name="groups[{{$kday}}][{{$kSchedule}}][0][schedule_field_parent]" value="{{$kSchedule}}" class="schedule-key-name">
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][name]" id="groups[{{$kday}}][{{$kSchedule}}][0][name]" class="form-control form-control-sm group-name">
                                        @foreach (get_group_names() as $grkey => $gr)
                                        <option value="{{$grkey}}">{{$gr}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][range_age_id]" id="groups[{{$kday}}][{{$kSchedule}}][0][range_age_id]" class="form-control form-control-sm range-name">
                                        @foreach ($aRanges as  $range)
                                        <option value="{{$range->id}}">{{$range->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="groups[{{$kday}}][{{$kSchedule}}][0][maximum_capacity]" id="groups[{{$kday}}][{{$kSchedule}}][0][maximum_capacity]" class="form-control form-control-sm capacity" max="{{config('happyfeet.group-max-num')}}" min="1">
                                </td>
                                <td>
                                    <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][0][schedule][start]" id="groups[{{$kday}}][{{$kSchedule}}][0][schedule][start]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm start-hour">
                                </td>
                                <td>
                                    <input type="time" name="groups[{{$kday}}][{{$kSchedule}}][0][schedule][end]" id="groups[{{$kday}}][{{$kSchedule}}][0][schedule][end]" min="{{$schedule['start']}}" max="{{$schedule['end']}}" class="form-control form-control-sm end-hour">
                                </td>
                                <td>
                                    <select name="groups[{{$kday}}][{{$kSchedule}}][0][state]" id="groups[{{$kday}}][{{$kSchedule}}][0][state]" class="form-control form-control-sm group-state">
                                        @foreach (get_states() as $kstate => $state)
                                        <option value="{{$kstate}}">{{$state}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm add-group-schedule"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
@endforeach