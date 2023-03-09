<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksLinkRequest extends FormRequest
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
        if ($this->routeIs('tasksLinks.update')) {
            $requirable = 'nullable';
        }
        return [
            'booking_id' => $requirable . '|integer',
            'link' => 'url|string|required',
            'description' => 'required|string',
        ];
    }
}
