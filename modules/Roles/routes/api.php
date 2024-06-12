<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\src\Http\Controllers\RoleController;


Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'roles.'
    ],
    function () {
        Route::resource('roles', RoleController::class);
    }
);
