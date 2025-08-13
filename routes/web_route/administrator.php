<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;

Route::prefix('admin')->middleware('permission:' . PERMISSION_AKSES_MENU_ADMINISTRATOR)->group(function () {

    // Route submenu admin
    Route::get('', [AdministratorController::class, 'admin'])
        ->middleware('permission:' . PERMISSION_SHOW_ADMIN)->name('user.admin');

    // Routes submenu role
    Route::prefix('role')->middleware('permission:' . PERMISSION_SHOW_ROLE)->group(function () {
        Route::get('', [AdministratorController::class, 'role'])->name('user.role');

        Route::get('{id}', [AdministratorController::class, 'roleDetail'])
            ->name('user.role.detail')->whereNumber('id');
    });
});
