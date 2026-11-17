<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteSettingsController;
use Illuminate\Support\Facades\Route;

// Admin panel (login lives at /admin/login, from Fortify).
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('site', [SiteSettingsController::class, 'edit'])->name('site.edit');
    Route::post('site', [SiteSettingsController::class, 'update'])->name('site.update');
});

require __DIR__.'/settings.php';

// Public website.
Route::view('/', 'site.home')->name('home');
