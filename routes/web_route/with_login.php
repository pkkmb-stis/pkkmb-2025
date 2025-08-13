<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\SertifikatPkbnController;
use App\Http\Controllers\CoCardController;
use App\Http\Controllers\SendAccountCredController;

Route::get('dashboard', [HomeController::class, 'dashboard'])->name('home.dashboard');
Route::get('profil', [HomeController::class, 'profil'])->name('home.profil');
Route::get('sertifikat/{id?}', [SertifikatController::class, 'index'])
    ->name('home.sertifikat')->whereNumber('id');
Route::get('sertifikat-pkbn/{id?}', [SertifikatPkbnController::class, 'index'])
    ->name('home.sertifikat-pkbn')->whereNumber('id');
Route::get('cocard/{id?}', [CoCardController::class, 'index'])
    ->name('home.cocard')->whereNumber('id');

// Send account credentials to user
// For security reasons, this route should be protected by authentication middleware
// Comment this route after used to send credentials
Route::get('send-cred/{file}', [SendAccountCredController::class, 'process']);