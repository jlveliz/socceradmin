<?php

namespace Futbol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonTypeRequest extends FormRequest
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
        
        if ($this->method() == 'POST') {
            $rules = [
                'name' => 'required|unique:person_type,name',
                'state' => 'required'
            ];
            
        }
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:person_type,name,'.$this->get('key');
        }


        if ($this->method() == 'DELETE') {
            $rules['id'] = 'is_used:person,person_type_id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'name.unique' => 'Ya existe un tipo de persona con el mismo nombre',
            'state.required' => 'Ingrese un estado',
            'id.is_used' => 'Ya existen usuarios registrados con este tipo de persona'
        ];
    }
}
