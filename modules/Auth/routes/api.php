<?php

use Illuminate\Support\Facades\Route;

use Modules\Auth\src\Http\Controllers\AuthController;


Route::group(
    [
        'prefix' => 'api',
        'name' => 'auth.'
    ],
    function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
        Route::get('check-token', [AuthController::class, 'checkToken']);
    }
);
