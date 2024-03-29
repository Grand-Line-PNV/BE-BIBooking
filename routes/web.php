<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\InfluencerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ApplyController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    "namespace" => "Admin",
    "prefix" => "/admin"
], function () {
    
    Route::group(["prefix" => "dashboard"], function () {
        Route::get('/', [DashboardController::class, "index"])->name('dashboard.index');
    });

    Route::group(["prefix" => "brand"], function () {
        Route::get('/', [BrandController::class, "index"])->name('brand.index');
    });

    Route::group(["prefix" => "influencer"], function () {
        Route::get('/', [InfluencerController::class, "index"])->name('influencer.index');
    });

    Route::group(["prefix" => "booking"], function () {
        Route::get('/', [BookingController::class, "index"])->name('booking.index');
    });


    Route::group(["prefix" => "revenue"], function () {
        Route::get('/', [RevenueController::class, "index"])->name('revenue.index');
    });

    Route::group(["prefix" => "feedback"], function () {
        Route::get('/', [FeedbackController::class, "index"])->name('feedback.index');
        Route::get('/delete/{id}', [FeedbackController::class, "delete"]);
    });

});

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('error', function () {
    return view('admin.error');
})->name('error');