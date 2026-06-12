<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["throttle:third-party:{{ module }}:web"])->group(function () {

    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function () {

        Route::get(
            '/',
            [\{{ Module }}\App\Http\Controllers\UserController::class, 'index']
        )->name('index');
    });
});