<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\HomeController;

Route::middleware('permission:' . PERMISSION_AKSES_MENU_INFORMASI)->group(function () {

    // Route Untuk Gallery
    Route::middleware('permission:' . PERMISSION_SHOW_GALLERY)
        ->get('gallery', [InformasiController::class, 'gallery'])->name('gallery');

    // Route Untuk Berita
    Route::prefix('berita')->middleware('permission:' . PERMISSION_SHOW_BERITA)->group(function () {
        Route::get('', [InformasiController::class, 'berita'])->name('berita');

        Route::get('tambah', [InformasiController::class, 'beritaAdd'])
            ->middleware('permission:' . PERMISSION_ADD_BERITA)->name('berita.add');

        Route::get('{id}', [InformasiController::class, 'beritaEdit'])
            ->middleware('permission:' . PERMISSION_UPDATE_BERITA)->name('berita.edit')->whereNumber('id');
    });

    // Route untuk pengumuman
    Route::middleware('permission:' . PERMISSION_SHOW_PENGUMUMAN)
        ->get('pengumuman', [InformasiController::class, 'pengumuman'])->name('pengumuman');

    // Route Untuk timeline
    Route::middleware('permission:' . PERMISSION_SHOW_TIMELINE)
        ->get('timeline', [InformasiController::class, 'timeline'])->name('timeline');

    // Route Untuk Materi
    Route::middleware('permission:' . PERMISSION_SHOW_MATERI)
        ->get('materi', [InformasiController::class, 'materi'])->name('materi');

    // Route Untuk FAQ
    Route::middleware('permission:' . PERMISSION_SHOW_FAQ)
        ->get('faq', [InformasiController::class, 'faq'])->name('faq');

    // Route Untuk Formulir
    Route::prefix('formulir')->middleware('permission:' . PERMISSION_SHOW_FORMULIR)->group(function () {
        Route::get('', [InformasiController::class, 'formulir'])->name('formulir');
        Route::get('{id}', [InformasiController::class, 'formulirDetail'])
            ->name('formulir.detail')->whereNumber('id');

        // Route untuk Sinkronisasi Data dengan Google Sheets
        Route::post('/sync', [InformasiController::class, 'syncData'])
            ->name('formulir.sync');
    });
});
