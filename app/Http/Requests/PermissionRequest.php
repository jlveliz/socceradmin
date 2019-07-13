<?php

namespace Futbol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
                'module_id' => 'required|exists:module,id',
                'name' => 'required|unique:permission,name',
                'type_id' => 'required|exists:permission_type,id',
                'description' => 'required'
            ];
        }
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:permission,name,'.$this->get('key');
        }


        if ($this->method() == 'DELETE') {
            $rules['id'] = 'is_used:permission_role,permission_id';
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'module_id.required' => 'Ingrese un módulo',
            'module_id.exists' => 'Ingrese un módulo válido',
            'parent_id.integer' => 'Ingrese un permiso padre válido',
            'order.integer' => 'Ingrese un orden válido',
            'name.required' => 'Ingrese un nombre válido',
            'name.unique' => 'Ya existe un permiso con este nombre',
            'type_id.required' => 'Ingrese un tipo de permiso',
            'type_id.exists'=>'Ingrese un tipo de permiso válido',
            'description.required' => 'Ingrese una descripción',
            'id.is_used' => 'El permiso ya se encuentra usado por un rol'
        ];
    }
}
