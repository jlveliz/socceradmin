<?php

namespace Futbol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AssistanceRequest extends FormRequest
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
        
        $rules = [
            'assistances' => 'required|array',
        ];

        if (!$this->has('assistances')) {
            
            return $rules;
        }

        foreach ($this->get('assistances') as $key => $assistanceUser) {
            foreach ($assistanceUser as $keyAssas => $assistance) {
                $rules['assistances.'.$keyAssas.'.assistance_id'] = 'exists:assistance';
            }
        }

        return $rules;

    }

    public function messages()
    {
        $messages = [
            'assistances.required' => 'Por favor, Ingrese al menos una asistencia',
            'assistances.array' => 'Por favor, ingrese las asistencias de manera correcta',
        ];


        if (!$this->has('assistances')) {
            
            return $messages;
        }

        foreach ($this->get('assistances') as $key => $assistanceUser) {
            foreach ($assistanceUser as $keyAssas => $assistance) {
                $messages['assistances.'.$keyAssas.'.assistance_id.exists'] = 'La Asistencia no existe';
            }
        }
       
        return $messages;
    }
}
