<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:role,name',
            'is_default' => 'required',
            'description' => 'required'
        ];
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:role,name,'.$this->get('key');
        }
        return $rules;
        
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre válido',
            'name.unique' => 'Ya existe un rol con este nombre',
            'is_default.required' => 'Identifique si es default',
            'description.required' => 'Ingrese una descripción'
        ];
    }
}
