<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// admin controllers
use \App\Http\Controllers\Api\AdminController\AuthAdminController;
use \App\Http\Controllers\Api\AdminController\BankController;
use \App\Http\Controllers\Api\AdminController\CountryController;
use \App\Http\Controllers\Api\AdminController\CityController;
use \App\Http\Controllers\Api\AdminController\MarketerController;
use \App\Http\Controllers\Api\AdminController\SellerCodeController;
use \App\Http\Controllers\Api\AdminController\HotelController;
use \App\Http\Controllers\Api\AdminController\SettingController;

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
    Route::controller(AuthAdminController::class)->group(function () {
        Route::post('/login', 'login');
    });
});
Route::group(['middleware' => ['auth:admin-api', 'cors', 'localization']], function () {
    Route::prefix('dashboard')->group(function () {
        Route::controller(AuthAdminController::class)->group(function () {
            Route::post('/change_password', 'changePassword');
            Route::post('/edit_account', 'edit_account');
            Route::post('/logout', 'logout');
            Route::get('admins', 'admins');
            Route::get('admins/{id}/details', 'get_admin');
            Route::post('admins/create', 'create');
            Route::post('admins/{id}/edit', 'edit');
            Route::get('admins/{id}/delete', 'delete');
        });
        // country routes
        Route::controller(CountryController::class)->group(function () {
            Route::get('countries', 'index');
            Route::get('country_cities/{id}', 'country_cities');
            Route::get('countries/{id}', 'show');
            Route::post('countries/create', 'create');
            Route::post('countries/{id}/edit', 'edit');
            Route::get('countries/{id}/delete', 'destroy');
        });
        // city routes
        Route::controller(CityController::class)->group(function () {
            Route::get('cities', 'index');
            Route::get('country_cities/{id}', 'country_cities');
            Route::get('cities/{id}', 'show');
            Route::post('cities/create', 'create');
            Route::post('cities/{id}/edit', 'edit');
            Route::get('cities/{id}/delete', 'destroy');
        });
        // bank routes
        Route::controller(BankController::class)->group(function () {
            Route::get('banks', 'index');
            Route::get('banks/{id}', 'show');
            Route::post('banks/create', 'create');
            Route::post('banks/{id}/edit', 'edit');
            Route::get('banks/{id}/delete', 'destroy');
        });
        // marketers routes
        Route::controller(MarketerController::class)->group(function () {
            Route::get('marketers', 'index');
            Route::get('marketers/{id}', 'show');
            Route::post('marketers/create', 'create');
            Route::post('marketers/{id}/edit', 'edit');
            Route::get('marketers/{id}/delete', 'destroy');
        });
        // seller_codes routes
        Route::controller(SellerCodeController::class)->group(function () {
            Route::get('seller_codes', 'index');
            Route::get('seller_codes/{id}', 'show');
            Route::post('seller_codes/create', 'create');
            Route::post('seller_codes/{id}/edit', 'edit');
            Route::get('seller_codes/{id}/delete', 'destroy');
        });
        // hotel routes
        Route::controller(HotelController::class)->group(function () {
            Route::get('hotels/{status}', 'index');
            Route::get('hotels/show/{id}', 'show');
            Route::post('hotels/create', 'create');
            Route::post('hotels/{id}/edit', 'edit');
            Route::post('hotels/{id}/archive', 'archive');
            Route::get('hotels/{id}/delete', 'destroy');
        });
        // setting routes
        Route::controller(SettingController::class)->group(function () {
            Route::get('settings', 'settings');
            Route::post('settings/edit', 'edit_setting');
        });
    });
});

//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
