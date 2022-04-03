<?php

use Illuminate\Support\Facades\Route;
use Mouyong\Sensitive\SensitiveController;

Route::group([
    'prefix' => 'sensitive',
    'middleware' => ['api']
], function () {
    Route::get('check', [SensitiveController::class, 'check']);
});