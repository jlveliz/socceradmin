<?php

namespace Futbol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFrontendRequest extends FormRequest
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
        // dd($this->all());
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'representant' =>'required',
            'representant.name' => 'required',
            'representant.last_name' => 'required',
            'representant.email' => 'required',
            'representant.mobile' => 'required',
            'enrollment' => 'required',
            'enrollment.field_id' => 'required|exists:field,id',
            'enrollment.day' => 'required',
            'enrollment.hour' => 'required',
        ];


        return $rules;

        
    }

    public function messages()
    {
        return [

            'name.required' => 'Por favor, ingrese un nombre',
            'last_name.required' => 'Por favor, ingrese un apellido',
            'age.required' => 'Por favor, ingrese una edad',
            'representant.required' =>'Por favor, ingrese los datos del representante',
            'representant.name.required' => 'Por favor, ingrese el nombre',
            'representant.last_name.required' => 'Por favor, ingrese un apellido',
            'representant.email.required' => 'Por favor, ingrese un correo',
            'representant.mobile.required' => 'Por favor, ingrese un teléfono',
            'enrollment.field_id.required' => 'Por favor, ingrese una cancha',
            'enrollment.field_id.exists' => 'Por favor, ingrese una cancha válida',
            'enrollment.day.required' => 'Por favor, ingrese un día',
            'enrollment.hour.required' => 'Por favor, ingrese una hora',
        ];
    }
}
