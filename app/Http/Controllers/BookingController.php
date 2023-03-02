<?php

namespace App\Http\Controllers;

use App\Events\BookingActions;
use App\Events\BookingNotifications;
use App\Models\Booking;
use App\Models\Campaign;
use App\Http\Requests\BookingRequest;
use App\Models\Account;
use Carbon\Carbon;
use App\Helpers\NotificationHelper;

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

        //send emails and notifations
        event(new BookingActions($booking));

        $influencerNotifyContent = 'Hi @' . $influencer->username . ', your booking is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($influencer->id, $influencerNotifyContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $influencerNotifyContent,
            'userId' => $influencer->id,
        ]));

        $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        $brandContent = 'Hi @' . $brand->username . ', your campaign has been booked by @' . $influencer->username . ' and it is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($brand->id, $brandContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $brandContent,
            'userId' => $brand->id,
        ]));

        return $this->commonResponse($booking);
    }

    public function show($id)
    {
        $booking = Booking::with(['feedbacks'])->findOrFail($id);
        return $this->commonResponse($booking);
    }

    //update: cancel, reject, confirmed, doingg
    public function update(BookingRequest $request, $id)
    {

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status ?? $booking->status,
            'started_date' => $request->started_date ?? $booking->started_date ?? null,
            'ended_date' => $request->ended_date ?? $booking->ended_date ?? null,
        ]);

        $campaign = Campaign::find($booking->campaign_id);

        //update campaign status 
        if ($booking->status == Booking::STATUS_CONFIRMED){
            $campaign->update ([
                'applied_number' => $campaign->applied_number + 1
            ]);
        }

        $influencer = Account::find($request->influencer_id);

        //send emails and notifications for both brands and influencera
        event(new BookingActions($booking));

        $influencerNotifyContent = 'Hi @' . $influencer->username . ', your booking is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($influencer->id, $influencerNotifyContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $influencerNotifyContent,
            'userId' => $influencer->id,
        ]));

        $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        $brandContent = 'Hi @' . $brand->username . ', your campaign has been booked by @' . $influencer->username . ' and it is in the #' . $booking->status . 'state now!';
        NotificationHelper::saveNotification($brand->id, $brandContent);
        event(new BookingNotifications([
            'time' => Carbon::now(),
            'message' => $brandContent,
            'userId' => $brand->id,
        ]));


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
