<?php

use Illuminate\Support\Facades\Route;
use Modules\Wedding\Http\Controllers\WeddingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('weddings', WeddingController::class)->names('wedding');
});
