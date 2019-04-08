<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachRequest extends FormRequest
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
            'username' => 'required|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'rep_password' => 'required|same:password',
            'state' => 'required'

        ];
        
        if ($this->method() == 'PUT') {
            $rules['username'] = 'required|unique:user,username,'.$this->get('key');
            $rules['email'] = 'required|unique:user,email,'.$this->get('key');
            $rules['password'] = 'required_with:password';
            $rules['rep_password'] = 'required_with:password|same:password';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Por favor, ingrese un nombre de usuario',
            'username.unique' => 'Ya se encuentra un usuario registrado con este nombre',
            'email.required' => 'Por favor ingrese un correo',
            'email.email' => 'Por favor ingrese un correo válido',
            'email.unique' => 'ya se encuentra un correo registrado',
            'name.required' => 'Por favor, ingrese un nombre',
            'last_name.required' => 'Por favor, ingrese un apellido',
            'password.required' => 'Ingrese una contraseña',
            'rep_password.required' => 'Por favor, ingrese la contraseña',
            'rep_password.same' => 'Las contraseñas no coinciden',
            'state.required' => 'El estado es requerido'
        ];
    }
}
