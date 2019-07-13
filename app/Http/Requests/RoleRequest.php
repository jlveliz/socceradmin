<?php

namespace Futbol\Http\Requests;

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
        if ($this->method() == 'POST') {
            $rules = [
                'name' => 'required|unique:role,name',
                'is_default' => 'required',
            ];
        }
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:role,name,'.$this->get('key');
        }

        if ($this->method() == 'DELETE') {
           
            $rules['id'] = 'is_used:user_role,role_id';
        }
        return $rules;
        
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre válido',
            'name.unique' => 'Ya existe un rol con este nombre',
            'is_default.required' => 'Identifique si es default',
            'description.required' => 'Ingrese una descripción',
            'id.is_used' => 'El Rol ya se encuentra usado por algún usuario'
        ];
    }
}
