<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'booking_id' => 'required|integer',
            'name' => 'required|string',
            'tranfer_type' => 'required|string',
            'description' => 'required|string',
            'bank_account' => 'required|integer|numeric',
            'date' => 'required|date',
            'number' => 'required|numeric',
            'evidence' =>'required'
        ];
    }
}