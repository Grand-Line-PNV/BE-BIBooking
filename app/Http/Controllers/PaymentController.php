<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Helpers\FileHelper;
use App\Models\Booking;
use App\Events\BookingActions;
use App\Events\BookingNotifications;
use App\Models\Account;
use App\Models\Campaign;
use App\Helpers\NotificationHelper;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function store(PaymentRequest $request)
    {
        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'name' => $request->name,
            'tranfer_type' => $request->tranfer_type,
            'description' => $request->description,
            'bank_account' => $request->bank_account,
            'number' => $request->number,
            'date' => $request->date
        ]);

        $paymentImage = FileHelper::uploadFileToS3($request->evidence, 'payments');
        $paymentImage->payment_id = $payment->id;
        $paymentImage->save();

        $booking = Booking::find($payment->booking_id);
        $booking->update([
            'payment_status' => 1,
            'status' => Booking::STATUS_PAID,
        ]);

        //send email and notification - paid status 
        event(new BookingActions($booking));

        $influencer = Account::find($booking->influencer_id);
        $campaign = Campaign::find($booking->campaign_id);

        $influencerNotifyContent = 'Hi @' . $influencer->username . ', your booking is in the #' . $booking->status . ' state now!';
        $this->sendNotification($influencer->id, $influencerNotifyContent);

        $brand = Account::where(['id' => $campaign->brand_id, 'role_id' => Account::ROLE_BRAND])->first();
        $brandNotifyContent = 'Hi @' . $brand->username . ', your campaign has been booked by @' . $influencer->username . ' and it is in the #' . $booking->status . ' state now!';
        $this->sendNotification($brand->id, $brandNotifyContent);

        return $this->commonResponse($payment);
    }
}
