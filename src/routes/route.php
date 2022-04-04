<?php

use Illuminate\Support\Facades\Route;
use Mouyong\Sensitive\Controllers\SensitiveController;

Route::group([
    'prefix' => 'sensitive',
    'middleware' => ['api']
], function () {
    Route::get('check', [SensitiveController::class, 'check']);
    Route::get('submit', [SensitiveController::class, 'submit']);
});