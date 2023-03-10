<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingHistoryController extends Controller
{

    //will list all the bookings that have the passed brandId,
    public function viewAllForBrand(Request $request)
    {
        $campaigns = Campaign::where('brand_id', $request->brandId)->get();
        $bookings = [];

        foreach ($campaigns as $campaign) {
            $booking = Booking::where('campaign_id', $campaign->id)->get();
            array_push($bookings, $booking);
        }

        if (empty($bookings)) {
            return $this->commonResponse([], "Brand does have any bookings.", 404);
        }

        return $this->commonResponse($bookings);
    }

    //when brand click on detail booking, they can view the booking with tasklinks, each booking 
    public function viewDetail($id)
    {
        $booking = Booking::with('tasksLinks')->findOrFail($id);
        return $this->commonResponse($booking);
    }

    // view all the list of bookings that influncer are doing, done, ....
    // when they click on each booking 
    public function viewAllForInfluencer(Request $request)
    {
        $bookings = Booking::where('influencer_id', $request->influencerId)->get();

        if (empty($bookings->toArray())) {
            return $this->responseError('Influencer does not have any campaign!');
        }

        return $this->commonResponse($bookings);
    }
}
