<?php

use Illuminate\Support\Facades\Route;
use Modules\Guest\Http\Controllers\GuestController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('guests', GuestController::class)->names('guest');
});
