<?php

namespace HappyFeet\Http\Requests;

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
        return [
            'module_id' => 'required|exists:module,name',
            'parent_id' => 'integer',
            'order' => 'integer',
            'name' => 'required',
            'type_id' => 'required|exists:permission_type,id',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'module_id.required' => 'Ingrese un módulo',
            'module_id.exists' => 'Ingrese un módulo válido',
            'parent_id.integer' => 'Ingrese un permiso padre válido',
            'order.integer' => 'Ingrese un orden válido',
            'name.required' => 'Ingrese un nombre válido',
            'type_id.required' => 'Ingrese un tipo de permiso',
            'type_id.exists'=>'Ingrese un tipo de permiso válido',
            'description.required' => 'Ingrese una descripción'
        ];
    }
}
