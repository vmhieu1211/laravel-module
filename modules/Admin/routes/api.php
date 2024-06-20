<?php
namespace Modules\Admin\routes;

use Illuminate\Support\Facades\Route;
use Modules\Admin\src\Http\Controllers\AdminController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'admins.'
    ],
    function () {
        Route::resource('admins', AdminController::class);
    }
);
