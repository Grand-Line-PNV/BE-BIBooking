<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'industry'=>'required|string',
            'hashtag' => 'required|string',
            'socialChannel' => 'required|string',
            'amount' => 'required|numeric',
            'require' => 'required|string',
            'interest' => 'required|string',
            'started_date' =>'required|date',
            'ended_date' =>'required|date',
            'campaignImages'=>'required',
            'productImages'=>'required',
            'campaignImages.*'=>'mimes:jpg,jpeg,png,bmp', 
            'productImages.*'=>'mimes:jpg,jpeg,png,bmp',
        ];
    }
}
