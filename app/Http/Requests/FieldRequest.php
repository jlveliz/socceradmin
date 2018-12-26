<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
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
            'name' => 'required|unique:field,name',
            'address' => 'required',
            'type' => 'required',
            'width' => 'required',
            'height' => 'required'
        ];
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:field,name,'.$this->get('key');
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre válido',
            'name.unique' => 'Ya existe una cancha con este nombre',
            'address.required' => 'Por favor, ingrese una dirección de cancha',
            'type.required' => 'Ingrese un tipo de cancha válido',
            'width.required' => 'Por favor, Ingrese un ancho de cancha válido',
            'height.required' => 'Por favor, Ingrese un largo de cancha válido',
        ];
    }
}
