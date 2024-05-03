<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\src\Http\Controllers\AuthController;
use Modules\Auth\src\Http\Controllers\ClientAuthController;

Route::middleware(['web'])->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
});

Route::group(['middleware' => ['web', 'CheckLogout']], function () {
    Route::get('logout', [AuthController::class, 'loginForm'])->name('logoutForm');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
