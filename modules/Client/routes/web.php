<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\src\Http\ClientController;

Route::group(['middleware' => ['web', 'CheckLogin']], function () {
    Route::resource('client', ClientController::class);
});
