<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('tentang', [HomeController::class, 'tentang'])->name('home.tentang');
Route::get('timeline', [HomeController::class, 'timeline'])->name('home.timeline');
Route::get('galeri', [HomeController::class, 'galeri'])->name('home.galeri');
Route::get('video', [HomeController::class, 'video'])->name('home.video');
Route::get('faq', [HomeController::class, 'faq'])->name('home.faq');
Route::get('ppo', [HomeController::class, 'ppo'])->name('home.ppo');
Route::get('dosen', [HomeController::class, 'dosen'])->name('home.dosen');

