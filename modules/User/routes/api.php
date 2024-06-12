<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;


Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'users.'
    ],
    function () {
        Route::resource('users', UserController::class);
    }
);
