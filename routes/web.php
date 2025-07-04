<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari', [SearchController::class, 'index'])->name('search');
Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/tentang-kami', function () {return view('pages.about');})->name('about');
Route::middleware('auth')->group(function () {});
Route::get('/pusat-bantuan', function () {return view('pages.help-center');})->name('help-center');
Route::get('/sewa-kos', function () {return view('pages.rent-kost');})->name('rent-kost');
Route::get('/promo', [PromoController::class, 'index'])->name('promos.index');
require __DIR__.'/auth.php';