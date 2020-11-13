<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PosEventStore extends FormRequest
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
            'event_id'=>['required'],
            'customer_service'=>['max:255'],
            'draft_beer_quality'=>['max:255'],
            'event_structure'=>['max:255'],
            'amount_beer_consumed'=>['max:255'],
            'make_new_event'=>['max:255'],
            'team_uniform'=>['max:255']
        ];
    }
}
