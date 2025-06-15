<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'available_vehicles' => Vehicle::where('status', 'available')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'total_drivers' => Driver::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
