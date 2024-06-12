<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\src\Http\Controllers\PostController;


Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api',
        'name' => 'posts.'
    ],
    function () {
        Route::resource('posts', PostController::class);
        Route::post('posts/{id}/like', [PostController::class, 'like'])->middleware('auth');
        Route::delete('posts/{id}/unlike', [PostController::class, 'unlike'])->middleware('auth');
    }
);
