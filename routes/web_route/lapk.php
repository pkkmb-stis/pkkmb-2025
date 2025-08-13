<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LapkController;

Route::prefix('lapk')->middleware('permission:' . PERMISSION_AKSES_MENU_LAPK)->group(function () {

    // Route submenu Atur Kelompok
    Route::prefix('kelompok')->middleware('permission:' . PERMISSION_SHOW_KELOMPOK)->group(function () {
        Route::get('', [LapkController::class, 'kelompok'])->name('lapk.kelompok');
        Route::get('{id}', [LapkController::class, 'detailKelompok'])->name('lapk.kelompok.detail');
    });

    // Route submenu Indikator
    Route::prefix('indikator')->middleware('permission:' . PERMISSION_SHOW_INDIKATOR_PENILAIAN)->group(function () {
        Route::get('', [LapkController::class, 'indikator'])->name('lapk.indikator');
    });
});
