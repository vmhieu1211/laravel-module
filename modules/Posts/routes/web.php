<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\src\Http\Controllers\PostController;

Route::group(['middleware' => ['web', 'CheckLogin']], function () {
    Route::resource('posts', PostController::class);
});
