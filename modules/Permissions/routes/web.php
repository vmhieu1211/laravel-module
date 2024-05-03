<?php


use Illuminate\Support\Facades\Route;
use Modules\Permissions\src\Http\Controllers\PermissionController;

Route::group(['middleware' => ['web', 'CheckLogin']], function () {
    Route::resource('permissions', PermissionController::class);
});
