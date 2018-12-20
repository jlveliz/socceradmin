<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|unique:module,name',
            'order' => 'required',
            'state' => 'required'
        ];
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:module,name,'.$this->get('key');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'order.required' => 'Por favor, ingrese un orden',
            'name.unique' => 'Ya existe un módulo con el mismo nombre',
            'state.required' => 'Ingrese un estado'
        ];
    }
}
