<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPEmail;
use App\Http\Controllers\VerificationController;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        VerificationController::sendEmailToConfirmAccount($account, VerificationController::generateOtp());
        return $this->commonResponse($account);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password', 'role_id']);
        $user = Account::where('email', $request->email)->first();

        if (!$token = auth()->attempt($credentials)) {
            return $this->commonResponse([], 'Your email or password is wrong!', 401);        }

        if ($user['verified'] == true) {
            $userData = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'account' => auth()->user()
            ];

            return $this->commonResponse($userData, "Login successfully!");
        }
        else {
            return $this->commonResponse([], 'Your account has not been activated!', 401);
        }
    }

    public function logout() {
        auth()->logout();
        return $this->commonResponse("Logout successfully!");
    }
}
