<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'socials' => 'required|array',
            'socials.*.id' => 'nullable|integer',
            'socials.*.name' => 'required|string',
            'socials.*.username' => 'required|string',
            'socials.*.fullname' => 'required|string',
            'socials.*.link' => 'required|string|url',
            'socials.*.subcribers' => 'required|numeric',
            'socials.*.avg_interactions'=>'required|numeric',
        ];
    }
}
