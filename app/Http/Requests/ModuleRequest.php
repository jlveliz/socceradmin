<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
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
            'name' => 'required|unique:module,name',
            'state' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'name.unique' => 'Ya existe un módulo con el mismo nombre',
            'state.required' => 'Ingrese un estado'
        ];
    }
}
