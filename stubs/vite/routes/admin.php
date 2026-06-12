<?php

use Illuminate\Support\Facades\Route;

/**
 * Register admin routes
 */

Route::middleware("throttle:third-party:{{ module }}:admin")->group(function () {

    Route::get('/admin', [
        \{{ Module }}\App\Http\Controllers\AdminController::class,
        'index'
    ])->name('admin.index');




    Route::group([
        'prefix' => 'settings',
        'as' => 'settings.'
    ], function () {
        Route::get(
            '/',
            [\{{ Module }}\App\Http\Controllers\SettingController::class, 'general']
        )->name('general');
    });
});
