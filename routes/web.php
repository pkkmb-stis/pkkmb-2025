<?php


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MabaController;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware('preventBackHistory')->group(function () {
    // Route tanpa login
    require __DIR__ . '/web_route/without_login.php';

    // Route untuk yang butuh login
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        // Route after login
        require __DIR__ . '/web_route/with_login.php';

        // Route Admin
        Route::prefix('a')->middleware('permission:' . PERMISSION_AKSES_ADMIN)->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('dashboard');

            // Route untuk menu administrator
            require __DIR__ . '/web_route/administrator.php';

            // Route untuk menu LAPK
            require __DIR__ . '/web_route/lapk.php';

            // Route Menu Tibum
            require __DIR__ . '/web_route/tibum.php';

            // Route Menu Maba
            require __DIR__ . '/web_route/maba.php';

            // Route Menu informasi umum
            require __DIR__ . '/web_route/informasi.php';

            // Route Menu pengawas
            require __DIR__ . '/web_route/pengawas.php';
        });
    });
});

// Route costum auth
require __DIR__ . '/web_route/auth.php';