<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Auth')->group(function() {
    Route::middleware('guest')->group(function(){
        Route::controller(SignupController::class)->group(function(){
            Route::post('sign-up','signUp');
            Route::post('/verify-otp','verifyOtp');
            Route::post('resend-otp','resendOTP');
        });
        Route::controller(AuthController::class)->group(function(){
            Route::post('login','login');
        });
    });
});

Route::controller(CarDetailsController::class)->group(function() {
    Route::post('/car-details','carDetails');
});

Route::controller(CarInsuranceInfo::class)->group(function() {
    Route::post('/car-insurance-info','carInsuranceInfo');
});

Route::controller(HealthInsuranceController::class)->group(function() {
    Route::post('/health-insurance','healthInsuranceInfo');
});

Route::controller(TwoServiceController::class)->group(function() {
    Route::post('/two-service','twoServiceInfo');
});

Route::middleware('auth:api')->group(function() {
    Route::controller(LogoutController::class)->group(function() {
        Route::post('/logout','logout');
    });
});
