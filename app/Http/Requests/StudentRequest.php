<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        
        $emtpyGroups = false;
        if ($this->has('enrollment.groups')) {
            if (!$this->get('enrollment.groups')) {
                $emtpyGroups = true;
            }
        }

        
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'date_birth' => 'required|date',
            'age' => 'required',
            'genre' => 'required',
            'state' => 'required',
            'representant.num_identification' => 'required',
            'representant.name' => 'required',
            'representant.last_name' => 'required',
            'representant.address' => 'required',
            'representant.email' => 'required|email',
            'enrollment.season_id' => 'required',
            'enrollment.field_id' => 'required',
            'enrollment.class_type' => 'required',
            'enrollment.groups' => 'required_if:state,==,1',
        ];

        if ($emtpyGroups) {
            $rules['enrollment.groups'] = 'required';
        }
        
        // if ($this->method() == 'PUT') {
        //     $rules['representant_num_identification'] = 'required|unique:person,num_identification'.$this->get('representant_person_id');
        // }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, ingrese un nombre del jugador',
            'last_name.required' => 'Por favor, ingrese un apellido del jugador',
            'date_birth.required' => 'Por favor, ingrese una fecha de nacimiento del jugador',
            'date_birth.date' => 'Por favor, ingrese una fecha de nacimiento válida',
            'age.required' => 'Por favor, ingrese una edad del jugador',
            'state.required' => 'Por favor, escoja un estado',
            'genre.required' => 'Por favor, ingrese un género del jugador',
            'representant.num_identification.required' => 'Por favor, ingrese una C.I de Representante',
            'representant.num_identification.unique' => 'Ya existe una identificación existente',
            'representant.name.required' => 'Por favor, ingrese el nombre del representante',
            'representant.last_name.required' => 'Por favor, Ingrese el apellido del representante',
            'representant.address.required' => 'Por Favor, Ingrese una dirección del representante',
            'representant.email.required' => 'Por Favor, Ingrese un correo del representante',
            'representant.email.email' => 'Por Favor, Ingrese un correo del representante válido',
            'enrollment.season_id.required' => 'Por favor, ingrese una temporada',
            'enrollment.field_id.required' => 'Por favor, ingrese una cancha',
            'enrollment.class_type.required' => 'Por favor Ingrese un tipo de clase',
            'enrollment.groups.required_if' => 'Por favor ingrese al menos un grupo',
            'enrollment.groups.required' => 'Por favor ingrese al menos un grupo',
        ];
    }
}
