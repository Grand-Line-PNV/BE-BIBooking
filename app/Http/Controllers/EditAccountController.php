<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Controllers\VerificationController;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgotPassword;
use App\Http\Requests\sendEmailRequest;


class EditAccountController extends Controller
{
    use ApiResponse;
    public function sendEmailForgotPassword(sendEmailRequest $request){
        $account = Account::where('email', $request->email)->first();
        VerificationController::sendEmailToConfirmAccount($account, VerificationController::generateOtp());
        return $this->responseSuccess();
    }
    public function changePassword(ForgotPassword $request){
        $user  = Account::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        if ($user) {
            return $this->responseSuccess();
        } else {
            return $this->responseSuccess();
        }
    }
}
