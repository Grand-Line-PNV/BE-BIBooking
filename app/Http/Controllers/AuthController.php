<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OTPRequest;
use App\Mail\OTPEmail;
use App\Traits\ApiResponse;


class AuthController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'requestOtp', 'verifyOtp']]);
    }

    public function requestOtp(OTPRequest $request)
    {
        $otp = rand(100000, 999900);
        $user = Account::where('email', $request->email)->first();

        if ($user) {

            $otpMail = new OTPEmail($user, $otp);
            Mail::to($user->email)->send($otpMail);

            Account::where('email', $request->email)->update(["otp" => $otp]);
            return $this->responseSuccessWithData(["message" => "OTP sent successfully"]);
        } else {
            return $this->responseErrorWithData(["message" => 'Invalid'], 401);
        }
    }
    public function verifyOtp(OTPRequest $request)
    {

        $user  = Account::where([['email', $request->email], ['otp', $request->otp]])->first();
        if ($user) {
            Account::where('email', $request->email)->update(['verified' => true]);

            return $this->responseSuccessWithData(["message" => "Success"]);
        } else {
            return $this->responseErrorWithData(["message" => 'Invalid'], 401);
        }
    }
    public function register(RegisterRequest $request)
    {
        $account = new Account([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        $account->save();
        return $this->responseSuccess();
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password', 'role_id']);
        $user = Account::where('email', $request->email)->first();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if ($user['verified'] == true) {

            return $this->createNewToken($token);
        }
        else {
            return $this->responseErrorWithData(["message" => 'Invalid'], 401);
        }
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'account' => auth()->user()
        ]);
    }
}
