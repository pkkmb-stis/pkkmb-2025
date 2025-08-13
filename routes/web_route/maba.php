<?php

use App\Http\Controllers\Admin\MabaController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission:' . PERMISSION_AKSES_MENU_MABA)->group(function () {

    // Route submenu user
    Route::prefix('user')->middleware('permission:' . PERMISSION_SHOW_USER)->group(function () {
        Route::get('', [MabaController::class, 'user'])->name('user.show');

        Route::get('{id}', [MabaController::class, 'userDetail'])
            ->name('user.detail')->whereNumber('id');

        Route::get('{id}/poin', [MabaController::class, 'userDetailPoin'])
            ->name('user.detail.poin')->whereNumber('id');
    });

    // Route Untuk buat Acara dan Absensi
    Route::prefix('absensi')->middleware('permission:' . PERMISSION_SHOW_EVENT)->group(function () {
        Route::get('', [MabaController::class, 'event'])->name('absensi');
        Route::get('{id}', [MabaController::class, 'eventDetail'])->name('absensi.detail');
    });

    // Route submenu Input Nilai
    Route::prefix('nilai')->middleware('permission:' . PERMISSION_SHOW_NILAI)->group(function () {
        Route::get('', [MabaController::class, 'inputNilai'])->name('input-nilai');
        Route::get('{id}', [MabaController::class, 'detailInputNilai'])
            ->name('input-nilai.detail')->whereNumber('id');
    });


    // Route submenu input poin
    Route::get('poin', [MabaController::class, 'inputPoin'])
        ->middleware('permission:' . PERMISSION_SHOW_POIN)->name('poin.table');

    // Route submenu poin user
    Route::get('poin-user', [MabaController::class, 'poinUser'])
        ->middleware('permission:' . PERMISSION_SHOW_POIN)->name('poin.user');

    // Route submenu poin kelompok
    Route::get('poin-kelompok', [MabaController::class, 'poinKelompok'])
        ->middleware('permission:' . PERMISSION_SHOW_POIN)->name('poin.poin-kelompok');

    // Route submenu kendala
    Route::get('kendala', [MabaController::class, 'kendala'])
        ->middleware('permission:' . PERMISSION_SHOW_KENDALA)->name('kendala');
});