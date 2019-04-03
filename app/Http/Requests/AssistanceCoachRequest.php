<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AssistanceCoachRequest extends FormRequest
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
            'coach_id' => 'required|exists:user,id',
            'date' => 'required'
        ];

        
        return $rules;

    }

    public function messages()
    {
        $messages = [
            'coach_id.required' => 'Por favor, ingrese un coach',
            'coach_id.exists' => 'Por favor, ingrese un coach válido',
            'date.required' => 'Por favor, ingrese una fecha',
            'profit.required' => 'Por favor, ingrese una ganancia'
        ];

        return $messages;
    }
}
