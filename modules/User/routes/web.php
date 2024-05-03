<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['middleware' => ['web', 'CheckLogin']], function () {
    Route::resource('users', UserController::class);
});
