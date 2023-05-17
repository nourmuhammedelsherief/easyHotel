<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\HotelController\AuthHotelController;
// hotel controllers

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['cors', 'localization'])->group(function () {
    Route::controller(AuthHotelController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/verify_phone_number', 'verify_phone');
    });
});
Route::group(['middleware' => ['auth:hotel-api', 'cors', 'localization']], function () {
    Route::prefix('dashboard')->group(function () {
        Route::controller(AuthHotelController::class)->group(function () {
            Route::post('/change_password', 'changePassword');
            Route::post('/edit_account', 'edit_account');
            Route::post('/logout', 'logout');
        });

    });
});
