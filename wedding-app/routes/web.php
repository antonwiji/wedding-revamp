<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Guest\InvitationController;
use App\Http\Controllers\Guest\RsvpController;
use Illuminate\Support\Facades\Route;

// ── PUBLIC ROUTES ──────────────────────────────────────────────
Route::get('/', fn () => view('pages.welcome'))->name('home');

Route::prefix('invitation')->name('invitation.')->group(function () {
    Route::get('/{code}', [InvitationController::class, 'show'])->name('show');
    Route::post('/{code}/rsvp', [RsvpController::class, 'store'])->name('rsvp');
});

// ── AUTH ROUTES ────────────────────────────────────────────────
require __DIR__.'/auth.php';

// Alias untuk redirect setelah login (dipakai middleware guest & Breeze)
Route::redirect('/dashboard', '/admin')->name('dashboard');

// ── ADMIN ROUTES ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('guests', GuestController::class);

    Route::get('export/guests', [GuestController::class, 'export'])->name('guests.export');
});
