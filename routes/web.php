<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('artisan-call',function(){
    Artisan::call('migrate');
    // Artisan::call('passport:install');
    return 'Migration completed';
});
Route::namespace('Auth')->middleware(['guest'])->group(function() {
    Route::controller(AuthController::class)->group(function(){
        Route::get('/','login')->name('login');
        Route::post('do-login','doLogin')->name('do.login');
    });
});

Route::middleware('auth')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/account-delete-request','accountDeleteRequest')->name('account.delete.request');
        Route::get('/logout','logout')->name('logout');
        Route::get('delete-account-list','deleteAccountList')->name('delete.account.list');
        Route::post('delete-account-recover','deleteAccountRecover')->name('delete.account.recover');
    });

    // Permission Mangement Route
    Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function(){
        Route::get('/','index')->name('index');
        Route::get("/create",'create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update','update')->name('update');
        Route::post('/delete','delete')->name('delete');
    });

    // Role Mangement Route

    Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function(){
        Route::get('/','index')->name('index');
        Route::get("/create",'create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update','update')->name('update');
        Route::post('delete','delete')->name('delete');
    });


    Route::controller(UserManagementController::class)->name('users.')->prefix('users')->group(function(){
        Route::get("/",'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update','update')->name('update');
        Route::post('/delete','delete')->name('delete');
        Route::get('/view-details/{id}','viewDetails')->name('view.details');
        Route::get('/car-details/{id}','carDetails')->name('car.details');
        Route::get('/car-insurance-info/{id}','carInsuranceInfo')->name('car.insurance.info');
        Route::get('/health-insurance-info/{id}','healthInsuranceInfo')->name('health.insurance.info');
        Route::get('/two-service-info/{id}','twoServiceInfo')->name('two.service.info');
        Route::get('/emergency-contact-info/{id}','emergencyContactInfo')->name('emergency.contact.info');
    });

    Route::controller(HelpController::class)->name('help.')->prefix('help')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/store','store')->name('store');
        Route::post('/update','update')->name('update');
    });

    Route::controller(AccountDeletionReasonController::class)->name('account.deletion.')->prefix('account-deletion')->group(function(){
        Route::get('/','index')->name('index');
        ROute::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update','update')->name('update');
        Route::post('/delete','delete')->name('delete');
    });

    Route::controller(AccidentDetailsController::class)->name('accident.')->prefix('accident')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/accident-image/{id}','accidentImage')->name('image');
    });
});