<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;


// Send Email to reset password
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['username' => 'required']);

    $status = Password::sendResetLink(
        $request->only('username')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Route attempt login
Route::post('login', [AuthController::class, 'login'])
    ->middleware('guest')->name('login');

// Route Logout
Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout');
