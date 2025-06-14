<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'approver') {
        return redirect()->route('approver.dashboard');
    }

    return redirect()->route('login');
});

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

     // Grup untuk Admin
    Route::middleware('role:admin')->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return '<h1>Selamat Datang di Dashboard Admin</h1>';
        })->name('dashboard');
        // Rute-rute admin lainnya (manajemen user, kendaraan, dll) akan ada di sini
        Route::resource('vehicles', VehicleController::class);
        Route::resource('drivers', DriverController::class);
    });

    // Grup untuk Approver
    Route::middleware('role:approver')->prefix('approver')->group(function () {
        Route::get('/dashboard', function () {
            return '<h1>Selamat Datang di Dashboard Approver</h1>';
        })->name('approver.dashboard');
        // Rute-rute approver lainnya (daftar persetujuan, dll) akan ada di sini
    });
});