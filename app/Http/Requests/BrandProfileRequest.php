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
            'brandName' => 'required|string|max:50|min:8',
            'website' => 'required|string',
            'industry'=>'required',
            'file_id'=>'required'
        ];
    }
}
