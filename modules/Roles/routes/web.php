<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\src\Http\Controllers\RoleController;


Route::group(['middleware' => ['web', 'CheckLogin']], function () {
    Route::resource('roles', RoleController::class);
});
