<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Helpers\FileHelper;
use App\Models\Booking;
use App\Events\BookingActions;
use App\Models\Account;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    //step 1: Just pass booking_id, enter description, bank_name (ncb) --> save these info to payments table -> sucess -> move to step 2
    //step 2: Direct to 1 VNpay UI --> Enter the name of bank_account, name, date  --> sucessfully

    public function create(PaymentRequest $request)
    {
        $booking = Booking::find($request->booking_id);
        if (empty($booking)) {
            return $this->commonResponse([], "Booking does not exist!", 404);
        }
        $campaign = Campaign::findOrFail($booking->campaign_id);
        if (empty($campaign)) {
            return $this->commonResponse([], "Campaign does not exist!", 404);
        }

        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'description' => $request->description,
            'number' => ($campaign->price) * 1.1,
            'date' => Carbon::now(),
            'bank_name' => $request->bank_name,
        ]);
        //step 2: Direct to 1 VNpay UI --> Enter the name of bank_account, name, date  --> sucessfully

        return $this->commonResponse($payment);
    }

    public function vnpay($id)
    {
        $payment = Payment::find($id);

        if (empty($payment)) {
            return $this->commonResponse([], "Payment does not exist!", 404);
        }

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "RTADUOL4";
        $vnp_HashSecret = "PBYUFFVCSWTBBTTNZUQWZUCSOHUUPCRE";

        $vnp_TxnRef = $payment->booking_id;
        $vnp_OrderInfo = $payment->description;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $payment->number * 100;
        $vnp_Locale = "en";
        $vnp_BankCode = $payment->bank_name;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        // if (isset($_POST['redirect'])) {
        // header('Location: ' . $vnp_Url);
        // die();
        // } else {
        //     echo json_encode($returnData);
        // }
        return redirect($vnp_Url);

        //Change the booking status
        $booking = Booking::find($payment->booking_id);
        $booking->update([
            'payment_status' => 1,
            'status' => Booking::STATUS_PAID,
        ]);

        //send email
        event(new BookingActions($booking));

        $influencer = Account::find($booking->influencer_id);
        $campaign = Campaign::find($booking->campaign_id);
        $influencerNotifyContent = "Hi @" . $influencer->username . ", brand have alreadly paid the money for the campaign! Let's do your tasks!";
        $this->sendNotification($influencer->id, $influencerNotifyContent);
    }
}