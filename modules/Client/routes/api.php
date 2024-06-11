<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\src\Http\ClientController;


Route::group(
    [
        'prefix' => 'api',
        'name' => 'client.'
    ],
    function () {
        Route::resource('client', ClientController::class);
    }
);
