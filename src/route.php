<?php

use Illuminate\Support\Facades\Route;
use Mouyong\Sensitive\SensitiveController;

Route::get('check', [SensitiveController::class, 'check']);