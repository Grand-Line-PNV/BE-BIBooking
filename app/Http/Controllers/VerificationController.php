<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtpRequest;
use App\Mail\OTPEmail;
use App\Models\Account;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class VerificationController extends Controller
{
    const OTP_PREFIX = 'OTP_CODE_';

    public static function sendEmailToConfirmAccount(Account $account, string $otp)
    {
        // Add new cache data
        // key: OTP_CODE_<account_id>
        // value: OTP
        // expire: after 5 mins
        $expiredAt = Carbon::now()->addMinutes(5);
        Cache::put(self::OTP_PREFIX . $account->id, $otp, $expiredAt);

        $otpMail = new OTPEmail($account, $otp);
        Mail::to($account->email)->send($otpMail);
    }

    public static function generateOtp(): int
    {
        return rand(100000, 999900);
    }

    public function verifyOtp(OtpRequest $request)
    {
        $account = Account::firstWhere('email', $request->email);

        if($account->verified) {
            return $this->commonResponse([], 'Account already activated!', 401);
        }

        // self::OTP_PREFIX . $account->id => example result: OTP_CODE_1
        if (Cache::get(self::OTP_PREFIX . $account->id) == $request->otp) {
            Account::where('email', $request->email)->update(['verified' => 1]);

            // Remove data from cache if the account already activated!
            Cache::forget(self::OTP_PREFIX . $account->id);

            return $this->commonResponse($account);
        }

        return $this->commonResponse([], 'Your OTP is wrong or has been expired!', 401);
    }
}
