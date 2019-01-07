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
            foreach(days_of_week() as  $kday => $day) {
                if(array_key_exists($kday,$this->get('available_days'))) {
                    $numSchedule = 0;
                    foreach($this->get('available_days') as $day => $schedule)  {
                        foreach($schedule as $keyAction => $hour) {
                            $rules['available_days.'.$kday.'.'.$numSchedule.'.'.$keyAction] = 'required';
                        }
                        $numSchedule++;
                    }  
                }
            }
        }
        
        dd($this->get('available_days'),$rules);
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:field,name,'.$this->get('key');
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
            'available_days.required' => 'Por favor, Ingrese algún horario'
        ];

        if (count($this->get('available_days')) > 0 ) {
            $countDay = 0;
            foreach(days_of_week() as  $kday => $day) {
                
                if(array_key_exists($kday,$this->get('available_days'))) {
                    $messages['available_days.'.$kday.'.schedule_'.$countDay.'.start.required'] = 'Ingrese una hora';
                    $messages['available_days.'.$kday.'.schedule_'.$countDay.'.end.required'] = 'Ingrese una hora';
                }
                $countDay++;
            }
        }

        return $messages;
    }
}
