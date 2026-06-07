<?php

use Illuminate\Support\Facades\Route;
use Modules\Wedding\Http\Controllers\WeddingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('weddings', WeddingController::class)->names('wedding');
});
