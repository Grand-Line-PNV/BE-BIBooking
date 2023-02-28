<?php

namespace App\Listeners;

use App\Events\BookingActions;
use App\Mail\SendBookingActionEmailToBrand;
use App\Mail\SendBookingActionEmailToInfluencer;
use App\Models\Account;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BookingEmailNotificationSender
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BookingActions $event)
    {
        $booking = $event->booking;
        $campain = Campaign::find($booking->campaign_id);
        $influencer = Account::where(['id' => $booking->influencer_id, 'role_id' => Account::ROLE_INFLUENCER])->first();
        $brand = Account::where(['id' => $campain->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        
        Mail::to($influencer->email)->send(new SendBookingActionEmailToInfluencer($booking,$influencer,$campain,$brand));
        Mail::to($brand->email)->send(new SendBookingActionEmailToBrand($booking,$influencer,$campain,$brand));
    }
}
