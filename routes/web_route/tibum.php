<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TibumController;

Route::middleware('permission:' . PERMISSION_AKSES_MENU_TIBUM)->group(function () {
    // Route submenu jenis poin
    Route::get('jenispoin', [TibumController::class, 'jenispoin'])
        ->middleware('permission:' . PERMISSION_SHOW_JENISPOIN)->name('jenispoin.table');


    Route::get('penebusan', [TibumController::class, 'penebusan'])
        ->middleware('permission:' . PERMISSION_SHOW_PENEBUSAN)->name('penebusan.index');
});
