<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStore extends FormRequest
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
            'name'=>['required', 'max:190'],
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->id),
            ],
            'document' => [
                'required',
                Rule::unique('users')->ignore($this->id),
            ],
        ];

        if(!$this->id){
            $rules['password']  = ['required', 'max:50'];
        }
        return $rules;
    }
}
