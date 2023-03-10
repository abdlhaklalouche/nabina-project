<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** 
 * This middleware for preventing authenticated people seeing login page again
 */
Route::middleware(["guest"])->group(function() {

    Auth::routes([
        'register' => false,
        "verify" => false,
        "reset" => false
    ]);

    
    Route::get('/reset_password', [App\Http\Controllers\Auth\CustomAuthController::class, 'reset_password'])->name('reset_password');
    Route::post('/reset_password', [App\Http\Controllers\Auth\CustomAuthController::class, 'reset_password_send']);

    Route::get('/change_password/{token}', [App\Http\Controllers\Auth\CustomAuthController::class, 'change_password'])->name('change_password');
    Route::post('/change_password/{token}', [App\Http\Controllers\Auth\CustomAuthController::class, 'change_password_send']);

});

/** 
 * This middleware for preventing guest from enetring to nabina website dashboard
 */
Route::middleware(["auth"])->group(function() {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'get'])->name('dashboard');
    Route::get('/employee', [App\Http\Controllers\DashboardController::class, 'employee'])->name('employee');
    Route::get('/logout', [App\Http\Controllers\Auth\CustomAuthController::class, 'logout'])->name('logout');

    /** 
     * This middleware for preventing normal users to access hr section and user account
     */
    Route::middleware(["auth.hr"])->group(function() {
       
        Route::get('/hr', [App\Http\Controllers\DashboardController::class, 'hr'])->name('hr');


        /** 
         * This middleware for preventing normal users and HR to access user account
         */
        Route::middleware(["auth.admin"])->group(function() {

            Route::get('/user-account', [App\Http\Controllers\DashboardController::class, 'user_account_get'])->name('user_account');
            
            Route::get('/user-account/new', [App\Http\Controllers\DashboardController::class, 'user_account_new'])->name('user_account_new');
            Route::post('/user-account/new', [App\Http\Controllers\DashboardController::class, 'user_account_store']);
            
            Route::get('/user-account/update/{id}', [App\Http\Controllers\DashboardController::class, 'user_account_view'])->name('user_account_update');
            Route::post('/user-account/update/{id}', [App\Http\Controllers\DashboardController::class, 'user_account_update']);

            Route::get('/user-account/delete/{id}', [App\Http\Controllers\DashboardController::class, 'user_account_delete'])->name('user_account_delete');
        });

    });

});