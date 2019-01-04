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
       
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'date_birth' => 'required|date',
            'age' => 'required',
            'genre' => 'required',
            'representant.num_identification' => 'required',
            'representant.name' => 'required',
            'representant.last_name' => 'required',
            'representant.address' => 'required',
            'representant.email' => 'required|email',
        ];
        
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
            'genre.required' => 'Por favor, ingrese un género del jugador',
            'representant.num_identification.required' => 'Por favor, ingrese una C.I de Representante',
            'representant.num_identification.unique' => 'Ya existe una identificación existente',
            'representant.name.required' => 'Por favor, ingrese el nombre del representante',
            'representant.last_name.required' => 'Por favor, Ingrese el apellido del representante',
            'representant.address.required' => 'Por Favor, Ingrese una dirección del representante',
            'representant.email.required' => 'Por Favor, Ingrese un correo del representante',
            'representant.email.email' => 'Por Favor, Ingrese un correo del representante válido'
        ];
    }
}
