<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfluencerProfileController;
use App\Http\Controllers\BrandProfileController;
use App\Http\Controllers\EditAccountController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AddressController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('users.register');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/verify-otp', [VerificationController::class, 'verifyOtp']);
Route::post('/send-email-to-change-password', [EditAccountController::class, 'sendEmailForgotPassword']);
Route::post('/change-password', [EditAccountController::class, 'changePassword']);


Route::group(['prefix' => 'influencer'], function () {
    Route::post('/create-info/{account_id}', [InfluencerProfileController::class, 'create']);
    Route::get('/view-myinfo/{account_id}', [InfluencerProfileController::class, 'view']);
    Route::get('/view-myaccount/{account_id}', [InfluencerProfileController::class, 'viewAccount']);
});

Route::group(['prefix' => 'brand'], function () {
    Route::post('/create-info', [BrandProfileController::class, 'create']);
    Route::get('/view-myinfo/{account_id}', [BrandProfileController::class, 'view']);
    Route::get('/view-myaccount/{account_id}', [BrandProfileController::class, 'viewAccount']);
    Route::post('/create-campaign', [CampaignController::class, 'create']);
    Route::delete('/delete-campaign/{campaignId}', [CampaignController::class, 'destroy']);
    Route::post('/edit-campaign/{campaignId}', [CampaignController::class, 'update']);
    Route::get('/view-detail-campaign/{campaignId}', [CampaignController::class, 'viewDetailCampaign']);
    Route::get('/view-all-campaigns', [CampaignController::class, 'viewCampaigns']);
 });

 Route::get('/provinces', [AddressController::class, 'loadprovince'])->name('address.provinces');
 Route::get('/districts/{province_code}', [AddressController::class, 'loaddistrict'])->name('address.districts');
 Route::get('/wards/{district_code}', [AddressController::class, 'loadward'])->name('address.wards');
 Route::get('/locations/{user_id}/{ward_code}', [AddressController::class, 'loaduserlocation'])->name('address.userlocation');
