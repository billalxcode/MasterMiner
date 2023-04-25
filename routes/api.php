<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WalletController;
use Illuminate\Http\Request;
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

Route::group(['as' => 'api.', 'middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('me', [AuthController::class, 'me'])->name('me');
        Route::post('reset_password', [AuthController::class, 'reset_password'])->name('reset_password');
    });

    Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
        Route::post('', [WalletController::class, 'mywallet'])->name('mywallet');
        Route::post('create', [WalletController::class, 'create'])->name('create');
        Route::post()
    });
});