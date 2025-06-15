<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'total_vehicles' => Vehicle::where('base_location_id', $user->location_id)->count(),
            'available_vehicles' => Vehicle::where('status', 'available')->where('base_location_id', $user->location_id)->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->where('start_location_id', $user->location_id)->count(),
            'total_drivers' => Driver::where('location_id', $user->location_id)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
