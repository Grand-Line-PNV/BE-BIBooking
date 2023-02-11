<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfluProfileRequest extends FormRequest
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
            'nickname' => 'required|string|max:50|min:8',
            'dob' => 'required|date',
            'followers'=>'required|numeric',
            'bookingPrice'=>'required|numeric',
            'industry'=>'required',
            'contentTopic'=>'required',
            'marialStatus'=>'required',
            'startedWork'=>'required|date',
            'file_id'=>'required',
            'link'=>'required'
        ];
    }
}