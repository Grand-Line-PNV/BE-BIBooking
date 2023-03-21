<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AudienceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'female' => 'required|numeric',
            'male' => 'required|numeric',
            'others' => 'required|numeric',
            'city1' => 'required|numeric',
            'city2' => 'required|numeric',
            'city3' => 'required|numeric',
            'city4' => 'required|numeric',
            'age1' => 'required|numeric',
            'age2' => 'required|numeric',
            'age3' => 'required|numeric',
            'age4' => 'required|numeric',


        ];
    }
}
