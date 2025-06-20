<?php

use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FuelLogController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceHistoryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Approver\ApprovalController;
use App\Http\Controllers\Approver\DashboardController;
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
        return redirect()->route('approver.index');
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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('vehicles', VehicleController::class);
        Route::resource('vehicles.fuel-logs', FuelLogController::class)->shallow();
        Route::resource('vehicles.service-history', ServiceHistoryController::class)->shallow();
        Route::resource('drivers', DriverController::class);
        Route::resource('reservations', ReservationController::class);
        Route::post('reservations/{reservation}/complete', [ReservationController::class, 'markAsCompleted'])->name('reservations.complete');

        Route::get('/api/charts/reservations', [ChartController::class, 'reservationData'])->name('api.charts.reservations');
    
        Route::controller(ReportController::class)->prefix('reports')->as('reports.')->group(function() {
            Route::get('/reservations', 'index')->name('reservations.index');
            Route::get('/reservations/export', 'export')->name('reservations.export');
        });
    });

    // Grup untuk Approver
    Route::middleware('role:approver')->prefix('approver')->as('approver.')->group(function () {
        Route::controller(ApprovalController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/{approval}/approve', 'approve')->name('approve');
            Route::post('/{approval}/reject', 'reject')->name('reject');
        });
    });
});