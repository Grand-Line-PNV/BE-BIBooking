<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfluencerProfileController;
use App\Http\Controllers\BrandProfileController;



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

Route::group(['prefix' => 'influencer'], function () {
    Route::post('/create/{account_id}', [InfluencerProfileController::class, 'create']);
    Route::get('/view/{account_id}', [InfluencerProfileController::class, 'view']);
    Route::get('/view-account/{account_id}', [InfluencerProfileController::class, 'viewAccount']);
});

Route::group(['prefix' => 'brand'], function () {
    Route::post('/create/{account_id}', [BrandProfileController::class, 'create']);
    Route::get('/view/{account_id}', [BrandProfileController::class, 'view']);
    Route::get('/view-account/{account_id}', [BrandProfileController::class, 'viewAccount']);
});

