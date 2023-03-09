<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
        $requirable = 'required';
        if ($this->routeIs('feedback.update')) {
            $requirable = 'nullable';
        }
        return [
            'booking_id' => $requirable . '|integer',
            'role_id' => $requirable . '|integer',
            'account_id' => $requirable . '|integer',
            'content' => 'required|string',
        ];
    }
}
