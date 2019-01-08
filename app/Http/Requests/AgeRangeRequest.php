<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgeRangeRequest extends FormRequest
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
            'name' => 'required|unique:age_range,name',
            'min_age' => 'required|min:1',
            'max_age' => 'required|max:'.config('happyfeet.max-age')
        ];
        
        if ($this->method() == 'PUT') {
            $rules['name'] = 'required|unique:age_range,name,'.$this->get('key');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor, Ingrese un nombre',
            'name.unique' => 'Ya existe un rango de edad con el mismo nombre',
            'min_age.required' => 'Ingrese una edad',
            'min_age.digits' => 'Solo ingrese dígitos',
            'min_age.min' => 'Edad inválida, mínimo un año',
            'max_age.required' => 'Ingrese una edad',
            'max_age.max' => 'Edad inválida',

        ];
    }
}
