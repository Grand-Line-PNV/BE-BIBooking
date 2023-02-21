<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandProfileRequest extends FormRequest
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
            'brand_name' => 'required|string|max:50',
            'website' => 'required|url',
            'industry'=>'required',
            'image'=>'required|file',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'dob'=>'date|required',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'address_line3' => 'required|string|max:255',
            'address_line4' => 'required|string|max:255',
        ];
    }
}
