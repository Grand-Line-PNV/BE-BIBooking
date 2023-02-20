<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPEmail;
use App\Http\Controllers\VerificationController;

class AuthController extends Controller
{
    use ApiResponse;

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
            $userData = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'account' => auth()->user()
            ];

            return $this->commonResponse($userData, "Login successfully!");
        }
        else {
            return $this->responseErrorWithData(["message" => 'Invalid'], 401);
        }
    }

    protected function commonResponse($data, $message = "", $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
