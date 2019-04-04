<?php

namespace HappyFeet\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupClassRequest extends FormRequest
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
        $rules = [];
        
        if ($this->method() == 'DELETE') {
            
            $rules['id'] = 'is_used:enrollment_groups,group_id';
        }
        
        return $rules;
    }

    public function messages()
    {
       
        $messages = [
            'id.is_used' => 'El grupo está siendo usado en alguna matricula'
        ];

        return $messages;
    }
}
