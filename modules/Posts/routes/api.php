<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\src\Http\Controllers\PostController;


Route::group(
    [
        // 'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'posts.'
    ],
    function () {
        Route::resource('posts', PostController::class);
    }
);
