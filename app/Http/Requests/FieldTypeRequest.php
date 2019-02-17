<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldTypeRequest extends FormRequest
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
            'name' => 'required|unique:field_type,name',
        ];
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:field_type,name,'.$this->get('key');
        }

        if ($this->method() == 'DELETE') {
            
            $rules['name'] = 'is_used';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, Ingrese un nombre',
            'name.unique' => 'Ya existe un tipo de cancha con este nombre',

        ];
    }
}
