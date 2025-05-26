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

Route::namespace('Auth')->middleware(['guest'])->group(function() {
    Route::controller(AuthController::class)->group(function(){
        Route::get('/','login')->name('login');
        Route::post('do-login','doLogin')->name('do.login');
    });
});

Route::middleware('auth')->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/logout','logout')->name('logout');
    });

    // Permission Mangement Route
    Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function(){
        Route::get('/','index')->name('index');
        Route::get("/create",'create')->name('create');
        Route::post('/store','store')->name('store');
    });

    Route::controller(UserManagementController::class)->name('users.')->prefix('users')->group(function(){
        Route::get("/",'index')->name('index');
    });
});
