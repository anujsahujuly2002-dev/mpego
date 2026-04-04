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

Route::namespace('Auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::controller(SignupController::class)->group(function () {
            Route::post('sign-up', 'signUp');
            Route::post('/verify-otp', 'verifyOtp');
            Route::post('resend-otp', 'resendOTP');
            Route::post("forget-password", "forgetPaswordLink");
        });
        Route::controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
        });
    });
});

Route::controller(CarDetailsController::class)->group(function () {
    Route::post('/car-details', 'carDetails');
    Route::post('/get-car-details', 'getCarDetails');
});

Route::controller(CarInsuranceInfo::class)->group(function () {
    Route::post('/car-insurance-info', 'carInsuranceInfo');
    Route::post('/get-car-insurance-info', 'getCarInsuranceInfo');
    Route::post("get-car-insurence-info-using-car-id", 'getCarInsurenceInfoUsingCarDetailsId');
    Route::post("update-car-insurence-info", 'carInsurenceInfoUpdate');
});
Route::controller(UserEmergencyController::class)->group(function () {
    Route::post('/user-emergency', 'store');
});

Route::controller(HealthInsuranceController::class)->group(function () {
    Route::post('/health-insurance', 'healthInsuranceInfo');
    Route::post('/get-health-insurance', 'getHealthInsuranceInfo');
    Route::post("medi-cal-store", "mediCalStore");
    Route::post("get-medi-cal-info", "getMedicalInfo");
    Route::post("private-card", 'privateCard');
    Route::post("get-private-card", "getPrivateCard");
});

Route::controller(TwoServiceController::class)->group(function () {
    Route::post('/two-service', 'twoServiceInfo');
    Route::post('/get-two-service', 'getTwoServiceInfo');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(LogoutController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::post('/change-password', 'changePassword');
        Route::post('account-delete', 'accountDelete');
        Route::post('user-token', 'userToken');
    });

    Route::controller(AccidentDetailsController::class)->group(function () {
        Route::post('/accident-details', 'accidentDetails');
        Route::get('get-previous-accident', 'getPreviousAccident');
        Route::post('exchange-id-and-insurance', 'exchangeIdAndInsurance');
        Route::get('get-exhange-id-and-insurance', 'getExchangeIdAndInsurance');
        Route::post("other-driver-id", "otherDriverId");
        Route::post('driver-insurance', 'driverInsurance');
        Route::post('drivers-registration-cards', 'driversRegistrationCards');
        Route::post("add-car-detail-and-car-insurence", "carDetailAndCarInsurence");
        Route::post("update-accident-info", "updateAccidentInfo");
        Route::post('get-accident-details-by-id', 'getAccidentDetailsById');
    });


    Route::controller(AccidentImageController::class)->group(function () {
        Route::post('/accident-scene-image', 'accidentSceneImage');
        Route::post("/delete-accident-scene-image", "deleteAccidentSceneImage");
        Route::post('/get-accident-image', 'getAccidentImage');
        Route::post('/vehicle-damage-image', 'vehicleDamageImage');
        Route::post('repair-estimate-image', 'repairEstimateImage');
        Route::post('/car-seats-image', 'carSeatsImage');
        Route::post('/injury-image', 'injuryImage');
        Route::post("police-report-image", "policeReportImage");
        Route::post("delete-vehicle-damage-image", "deleteVehicleDamageImage");
        Route::post("delete-repair-estimate-image", "deleteRepairEstimateImage");
        Route::post("delete-car-seats-image", "deleteCarSeatsImage");
        Route::post("delete-injury-image", "deleteInjuryImage");
        Route::post("delete-police-report-image", "deletePoliceReportImage");
    });

    Route::controller(UserEmergencyController::class)->group(function () {
        Route::post('/get-user-emergency', 'getUserEmergency');
        Route::post('/update-user-emergency', 'update');
        Route::post('delete-user-emergency', 'delete');
        Route::get('/help-info', 'helpInfo');
        Route::get('/account-delete-reasons', 'getAccountDeleteReasons');
        Route::post('gift-card-list', "giftCardList");
        Route::get('notification-list', 'notificationList');
        Route::post('gift-scratch', 'updateScratchedAt');
        Route::post('/service-request', 'storeServiceRequest');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/get-profile', 'getProfile');
        Route::patch('/update-profile', 'updateProfile');
    });
});
