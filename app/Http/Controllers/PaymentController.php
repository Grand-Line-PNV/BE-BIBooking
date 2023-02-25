<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Helpers\FileHelper;
use App\Models\Booking;


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
            'date'=>$request->date
        ]);
        $payment->save();

        $paymentImage = FileHelper::uploadFileToS3($request->evidence, 'payments');
        $paymentImage->payment_id = $payment->id;
        $paymentImage->save();

        $booking = Booking::find($payment->booking_id);
        $booking->update([
            'payment_status' => 1,
            'status' => Booking::STATUS_PAID,
        ]);

        return $this->commonResponse($payment);
    }
}
