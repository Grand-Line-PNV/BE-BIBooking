<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingHistoryController extends Controller
{

    //will list all the bookings that have the passed brandId,
    public function viewAllForBrand($brandId)
    {
        $campaigns = Campaign::where('brand_id', $brandId)->get();

        $bookings = [];

        foreach ($campaigns as $campaign) {
            $booking = Booking::with(['influencer', 'influencer.credential', 'campaign', 'feedbacks'])->where('campaign_id', $campaign->id)->get()->toArray();
            $bookings = array_merge($bookings, $booking);
        }

        if (empty($bookings)) {
            return $this->commonResponse([], "Brand does have any bookings.", 404);
        }

        return $this->commonResponse($bookings);
    }

    //when brand click on detail booking, they can view the booking with tasklinks, each booking 
    public function viewDetail($id)
    {
        $booking = Booking::with('tasksLinks')->find($id);
        if (empty($bookings)) {
            return $this->commonResponse([], "Booking does not exist!", 404);

        }
        return $this->commonResponse($booking);
    }

    // view all the list of bookings that influncer are doing, done, ....
    // when they click on each booking 
    public function viewAllForInfluencer($influencerId)
    {
        $bookings = Booking::with(['campaign', 'campaign.brand', 'feedbacks'])->where('influencer_id', $influencerId)->get();

        if (empty($bookings->toArray())) {
            return $this->commonResponse([], "Influencer does not have any campaign!", 404);

        }

        return $this->commonResponse($bookings);
    }
}
