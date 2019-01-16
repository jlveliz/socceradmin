<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        dd($this->all());
        if(!$this->has('available_days')) {
            $this->request->add(['available_days' => []]);
        }

       
        $rules = [
            'name' => 'required|unique:field,name',
            'address' => 'required',
            'type' => 'required',
            'available_days' => 'required'
        ];

        
        //insert required on days
        if (count($this->get('available_days')) > 0 ) {
           
            $numSchedule = 0;
            foreach($this->get('available_days') as $day => $schedule)  {
                foreach($schedule as $nameSchedule => $actions) {
                    foreach($actions as $action => $hours)
                    $rules['available_days.'.$day.'.'.$nameSchedule.'.'.$action] = 'required';
                }
                $numSchedule++;
            }  
               
        }
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:field,name,'.$this->get('key');
            $rules['groups'] = 'required';
            if( count($this->get('groups')) > 0 ){
                foreach($this->get('groups') as $kday => $schedules) {
                    if(array_key_exists($kday,days_of_week())) {
                        foreach($schedules as $kschudele => $groups) {
                            $countGroup = 0;
                            foreach($groups as $kgroup => $group) {
                                foreach($group as $kgrDetail => $detail) {
                                    $rules['groups.'.$kday.'.'.$kschudele.'.'.$countGroup.'.'.$kgrDetail] = 'required';
                                }
                                $countGroup++;
                            }
                        }
                    }
                }
            }
        }
        
        return $rules;
    }

    public function messages()
    {
        $messages =  [
            'name.required' => 'Ingrese un nombre válido',
            'name.unique' => 'Ya existe una cancha con este nombre',
            'address.required' => 'Por favor, ingrese una dirección de cancha',
            'type.required' => 'Ingrese un tipo de cancha válido',
            'available_days.required' => 'Por favor, Ingrese algún horario',
            'groups' => 'Por favor, ingrese al menos un grupo'
        ];

        //schedule field
        if (count($this->get('available_days')) > 0 ) {
            $numSchedule = 0;
            foreach($this->get('available_days') as $day => $schedule)  {
                foreach($schedule as $nameSchedule => $actions) {
                    foreach($actions as $action => $hours)
                    $messages['available_days.'.$day.'.'.$nameSchedule.'.'.$action.'.required'] = 'Ingrese una hora';
                }
                $numSchedule++;
            }
        }

        //group chedule field
        if( count($this->get('groups')) > 0 ){
            foreach($this->get('groups') as $kday => $schedules) {
                if(array_key_exists($kday,days_of_week())) {
                    foreach($schedules as $kschudele => $groups) {
                        $countGroup = 0;
                        foreach($groups as $kgroup => $group) {
                            foreach($group as $kgrDetail => $detail) {
                                $messages['groups.'.$kday.'.'.$kschudele.'.'.$countGroup.'.'.$kgrDetail.'.required'] = 'Po favor ingrese un detalle';
                            }
                            $countGroup++;
                        }
                    }
                }
            }
        }

       
        return $messages;
    }
}
