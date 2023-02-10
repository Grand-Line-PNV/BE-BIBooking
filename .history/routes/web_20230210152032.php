<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\InfluencerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DashboardController;
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
});

Route::get('/', function () {
    return view('admin.master');
});

Route::get('error', function () {
    return view('admin.error');
})->name('error');