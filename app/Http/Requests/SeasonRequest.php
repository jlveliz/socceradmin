<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeasonRequest extends FormRequest
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
                'name' => 'required|unique:season,name',
                'start_date' => 'required',
                'end_date' => 'required'
            ];
        }


        if ($this->method() == 'PUT') {
            $rules['name'] = "required|unique:season,name,".$this->get('key');
        }

        if ($this->method() == 'DELETE') {
            $rules['id'] = "is_active:season";
        }


        return $rules;


    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor ingrese un nombre',
            'name.unique' => 'Por favor ingrese otro nombre',
            'start_date.required' => 'Por favor, Ingrese una duración',
            'end_date.required' => 'Por favor, Ingrese una duración',
            'is_active' => 'La sesión que intenta eliminar se encuentra activa'
        ];
    }
}
