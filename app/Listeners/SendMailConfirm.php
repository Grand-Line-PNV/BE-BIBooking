<?php

namespace App\Listeners;

use App\Events\OrderBooking;
use App\Mail\SendBookingConfirmationInfluencer;
use App\Mail\SendBookingConfirmationBrand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;



class SendMailConfirm
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
     * @param  \App\Events\OrderBooking  $event
     * @return void
     */
    public function handle(OrderBooking $event)
    {
        $booking = $event->booking;

        $influencer = Account::where('id',$booking->influencer_id)->first();

        $brand = DB::table('bookings')
        ->join('campaigns', 'campaigns.id', '=', 'bookings.campaign_id')
        ->join('accounts','accounts.id', 'campaigns.brand_id')
        ->where('bookings.id',$booking->id)
        ->first();

        Mail::to($influencer->email)
        ->send(new SendBookingConfirmationInfluencer($booking));

        Mail::to($brand->email)
        ->send(new SendBookingConfirmationBrand($booking));
    }
}
