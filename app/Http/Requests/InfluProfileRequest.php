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
            'nickname' => 'required|string|max:50',
            'fullname' =>'required|string|max:255',
            'dob' => 'required|date',
            'phone_number'=>'required|string',
            'gender' => 'required|string|max:255',
            'job' => 'required|string|max:255',
            'title_for_job' =>'required',
            'description' => 'required',
            'experiences' => 'required',
            'content_topic'=>'required',
            'booking_price' =>'required|numeric',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'address_line3' => 'required|string|max:255',
            'address_line4' => 'required|string|max:255',

        ];
    }
}