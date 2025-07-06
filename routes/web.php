<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KostController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rute resource untuk Kost (mencakup create, store, edit, update, destroy)
    Route::resource('kosts', AdminController::class)->except(['show']); 

    // Rute khusus untuk manajemen kamar
    Route::get('/kosts/{kost}/rooms', [AdminController::class, 'rooms'])->name('kosts.rooms');

    // Rute untuk booking (jika Anda akan mengimplementasikannya)
});

Route::get('/kost/{slug}', [KostController::class, 'show'])->name('kosts.show');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari', [SearchController::class, 'index'])->name('search');
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/tentang-kami', function () {
    return view('pages.about');
})->name('about');
Route::middleware('auth')->group(function () {});
Route::get('/pusat-bantuan', function () {
    return view('pages.help-center');
})->name('help-center');
Route::get('/sewa-kos', function () {
    return view('pages.rent-kost');
})->name('rent-kost');
Route::get('/promo', [PromoController::class, 'index'])->name('promos.index');
Route::get('/bookings/{booking}', [AdminController::class, 'booking'])->name('kost.booking');

require __DIR__.'/auth.php';