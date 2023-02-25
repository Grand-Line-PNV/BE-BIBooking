<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Mail\OTPEmail;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\ApiResponse;


class VerificationController extends Controller
{
    use ApiResponse;

    public static function sendEmailToConfirmAccount(Account $account, string $otp)
    {
        $otpMail = new OTPEmail($account, $otp);
        Mail::to($account->email)->send($otpMail);
        Account::where('email', $account->email)->update(["otp" => $otp]);
    }

    public static function generateOtp(): int
    {
        return rand(100000, 999900);
    }
    public function verifyOtp(OtpRequest $request)
    {
        $user  = Account::where([['email', $request->email], ['otp', $request->otp]])->first();

        if ($user) {
            Account::where('email', $request->email)->update(['verified' => true]);
            return $this->commonResponse($user);
        } else {
            return $this->commonResponse([], 'Your OTP is wrong', 401);
        }
    }
}
