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
    Route::post('/get-car-details','getCarDetails');
});

Route::controller(CarInsuranceInfo::class)->group(function() {
    Route::post('/car-insurance-info','carInsuranceInfo');
    Route::post('/get-car-insurance-info','getCarInsuranceInfo');
});

Route::controller(HealthInsuranceController::class)->group(function() {
    Route::post('/health-insurance','healthInsuranceInfo');
    Route::post('/get-health-insurance','getHealthInsuranceInfo');
});

Route::controller(TwoServiceController::class)->group(function() {
    Route::post('/two-service','twoServiceInfo');
    Route::post('/get-two-service','getTwoServiceInfo');
});

Route::middleware('auth:api')->group(function() {
    Route::controller(LogoutController::class)->group(function() {
        Route::post('/logout','logout');
        Route::post('/change-password','changePassword');
        Route::post('account-delete','accountDelete');
        Route::post('user-token','userToken');
    });

    Route::controller(AccidentDetailsController::class)->group(function() {
        Route::post('/accident-details','accidentDetails');
        Route::get('get-previous-accident','getPreviousAccident');
    });


    Route::controller(AccidentImageController::class)->group(function() {
        Route::post('/accident-scene-image','accidentSceneImage');
        Route::post('/get-accident-image','getAccidentImage');
        Route::post('/vehicle-damage-image','vehicleDamageImage');
        Route::post('repair-estimate-image','repairEstimateImage');
        Route::post('/car-seats-image','carSeatsImage');
        Route::post('/injury-image','injuryImage');
    });

    Route::controller(UserEmergencyController::class)->group(function() {
        Route::post('/user-emergency','store');
        Route::post('/get-user-emergency','getUserEmergency');
        Route::get('/help-info','helpInfo');
        Route::get('/account-delete-reasons','getAccountDeleteReasons');
    });

});
