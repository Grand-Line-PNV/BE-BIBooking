<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        if ($this->routeIs('booking.update')) {
            $requirable = 'nullable';
        }

        return [
            'campaign_id' => $requirable . '|integer',
            'influencer_id' => $requirable . '|integer',
            'status' => 'string|in:' . implode(',', Booking::BOOKING_STATUS),
            'payment_status' => 'nullable|boolean|required_if:status,==,' . Booking::STATUS_PAID,
            'started_date' => 'nullable|date|required_if:status,==,' . Booking::STATUS_CONFIRMED,
            'ended_date' => 'nullable|date|required_if:status,==,' . Booking::STATUS_DONE,
        ];
    }
}
