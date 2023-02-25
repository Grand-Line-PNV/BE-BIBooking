<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Campaign;
use App\Http\Requests\BookingRequest;
use App\Models\Account;


class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('feedbacks')->get();
        return $this->commonResponse($bookings);
    }

    public function store(BookingRequest $request)
    {
        $campaign = Campaign::find($request->campaign_id);
        if (empty($campaign)) {
            return $this->commonResponse([], "Campain does not exist.", 404);
        }

        $influencer = Account::find($request->influencer_id);
        if (empty($influencer)) {
            return $this->commonResponse([], "Influencer does not exist.", 404);
        }

        $booking = Booking::create([
            'campaign_id' => $campaign->id,
            'influencer_id' => $influencer->id,
            'status' => Booking::STATUS_WAITING,
            'started_date' => null,
            'ended_date' => null,
            'payment_status' => 0,
        ]);

        return $this->commonResponse($booking);
    }

    public function show($id)
    {
        $booking = Booking::with(['feedbacks'])->findOrFail($id);
        return $this->commonResponse($booking);
    }

    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status ?? $booking->status,
            'started_date' => $request->started_date ?? $booking->started_date ?? null,
            'ended_date' => $request->ended_date ?? $booking->ended_date ?? null,
            // 'payment_status' => $request->payment_status ?? $booking->payment_status ?? 0,
        ]);

        return $this->commonResponse($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->load(['feedbacks']);

        foreach ($booking->feedbacks as $item) {
            $item->delete();
        }

        $booking->delete();

        $this->commonResponse([], "Booking has deleted success.");
    }


}
