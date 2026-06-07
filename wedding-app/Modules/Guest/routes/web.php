<?php

use Illuminate\Support\Facades\Route;
use Modules\Guest\Http\Controllers\GuestController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('guests', GuestController::class)->names('guest');
});
