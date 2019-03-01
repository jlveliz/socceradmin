<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionTypeRequest extends FormRequest
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
                'name' => 'required|unique:permission_type,name',
                'state' => 'required'
            ];
        }

        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:permission_type,name,'.$this->get('key');
        }

        if ($this->method() == 'DELETE') {
            $rules['id'] = 'is_used:permission,type_id';
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'name.unique' => 'Ya existe un tipo de permiso con el mismo nombre',
            'state.required' => 'Ingrese un estado',
            'id.is_used' => 'El tipo de permiso se encuentra usado por un permiso'
        ];
    }
}
