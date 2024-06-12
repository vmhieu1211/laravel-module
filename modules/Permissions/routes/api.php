<?php

use Illuminate\Support\Facades\Route;
use Modules\Permissions\src\Http\Controllers\PermissionController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'permissions.'
    ],
    function () {
        Route::resource('permissions', PermissionController::class);
    }
);
