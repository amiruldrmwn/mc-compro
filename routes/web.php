<?php

use Illuminate\Support\Facades\Route;

// Admin panel (login lives at /admin/login, from Fortify).
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::inertia('/', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

// Public website.
Route::view('/', 'site.home')->name('home');
