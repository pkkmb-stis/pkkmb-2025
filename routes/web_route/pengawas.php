<?php

use App\Http\Controllers\Admin\PengawasController;
use Illuminate\Support\Facades\Route;

Route::middleware('permission:' . PERMISSION_SHOW_LAPORAN_KEGIATAN)->group(function () {
    // Route submenu laporan kegiatan
    Route::get('laporan-kegiatan', [PengawasController::class, 'laporanKegiatan'])
        ->middleware('permission:' . PERMISSION_SHOW_LAPORAN_KEGIATAN)->name('laporankegiatan');
});