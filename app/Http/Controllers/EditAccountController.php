<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VerificationController;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgotPassword;
use App\Http\Requests\sendEmailRequest;


class EditAccountController extends Controller
{
    public function sendEmailForgotPassword(sendEmailRequest $request)
    {
        $account = Account::where('email', $request->email)->first();
        Account::where('email', $request->email)->update(['verified' => false]);
        VerificationController::sendEmailToConfirmAccount($account, VerificationController::generateOtp());
        return $this->commonResponse($account);
    }

    public function changePassword(ForgotPassword $request)
    {
        $user  = Account::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        if ($user) {
            return $this->commonResponse([], 'You have changed your password successfully');
        }
        return $this->commonResponse([], 'Can not update your password, please try again!', 401);
    }
}
