<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Requests\RegisterRequest;
use GuzzleHttp\Psr7\Message;
use App\Models\Account;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $account = new Account([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'file_id' => $request->file_id,
            'role_id' => $request->role_id,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_line4' => $request->address_line4,
        ]);
        $account->save();
        return response()->json(['message' => "User has been registered"], 200);
    }
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        // $account = $request->user();
        // $tokenResult = $account->createToken('Personal Access Token');
        // $token = $tokenResult->tokens();
        // $token->expires_at = Carbon::now()->addWeek(1);
        // $token->save();
        // return response()->json([
        //     'data' => [
        //         'account' => Auth::account(),
        //         'access_token' => $tokenResult->accessToken,
        //         'token_type' => 'Bearer',
        //         'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        //     ]
        // ]);
        $token = $request->user()->createToken('Personal Access Token');
        return response()->json([
            'data' => [
                'account' => Auth::user(),
                'token'=>$token,            ]
        ]);
    }
}
