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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FilterCampaignController;
use App\Http\Controllers\FilterInfluencerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TasksLinkController;

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
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verify-otp', [VerificationController::class, 'verifyOtp']);
    Route::post('/send-email-to-change-password', [EditAccountController::class, 'sendEmailForgotPassword']);
    Route::post('/change-password', [EditAccountController::class, 'changePassword']);
});


Route::group(['prefix' => 'influencer'], function () {
    Route::post('/create-info', [InfluencerProfileController::class, 'createInfluencerProfile']);
    Route::get('/view-myinfo/{account_id}', [InfluencerProfileController::class, 'view']);
    Route::get('/view-myaccount/{account_id}', [InfluencerProfileController::class, 'viewAccount']);
});

Route::group(['prefix' => 'brand'], function () {
    Route::post('/create-info', [BrandProfileController::class, 'create']);
    Route::post('/edit-info/{id}', [BrandProfileController::class, 'update'])->name('brand.update');
    Route::get('/view-myinfo/{id}', [BrandProfileController::class, 'view']);
    Route::delete('/delete-myinfo/{id}', [BrandProfileController::class, 'delete']);
    Route::post('/create-campaign', [CampaignController::class, 'create']);
    Route::delete('/delete-campaign/{campaignId}', [CampaignController::class, 'destroy']);
    Route::post('/edit-campaign/{campaignId}', [CampaignController::class, 'update'])->name('campaign.update');
    Route::get('/get-detail-campaign/{campaignId}', [CampaignController::class, 'viewDetailCampaign']);
    Route::post('/get-all-campaigns', [CampaignController::class, 'viewCampaigns']);
    //brand view their campaigns
});

Route::get('/provinces', [AddressController::class, 'loadprovince'])->name('address.provinces');
Route::get('/districts/{province_code}', [AddressController::class, 'loaddistrict'])->name('address.districts');
Route::get('/wards/{district_code}', [AddressController::class, 'loadward'])->name('address.wards');
Route::get('/locations/{user_id}/{ward_code}', [AddressController::class, 'loaduserlocation'])->name('address.userlocation');

Route::group(['prefix' => 'bookings'], function () {
    Route::post('/create', [BookingController::class, 'store']);
    Route::get('/get-detail/{bookingId}', [BookingController::class, 'show']);
    Route::get('/get-list', [BookingController::class, 'index']);
    Route::post('/update/{bookingId}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/delete/{bookingId}', [BookingController::class, 'destroy']);
});

Route::group(['prefix' => 'tasks'], function () {
    Route::post('/create', [TasksLinkController::class, 'store']);
    Route::get('/update', [TasksLinkController::class, 'edit'])->name('tasksLinks.update');
});

//ifnluencer apply campaign and brand search 
Route::post('/filter-campaign', [CampaignController::class, 'filter']);
Route::post('/filter-influencer', [FilterInfluencerController::class, 'index']);

Route::group(
    ['prefix' => 'feedback'],
    function () {
        Route::post('/create', [FeedbackController::class, 'store']);
        Route::post('/update/{id}', [FeedbackController::class, 'edit'])->name('feedback.update');
        Route::delete('/delete/{id}', [FeedbackController::class, 'destroy']);
    }
);

//payment controller
Route::group(
    ['prefix' => 'payment'],
    function () {
        Route::post('/create-payment', [PaymentController::class, 'create']);
        Route::post('/vnpay/{id}', [PaymentController::class, 'vnpay']);
    }
);
