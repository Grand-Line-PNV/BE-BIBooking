<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
        $requirable = 'nullable';
        if ($this->routeIs('services.update')) {
            $requirable = 'required';
        }
        return [
            'services.*.name' => 'required|string',
            'services.*.description' => $requirable . '|string',            
        ];
    }
}
