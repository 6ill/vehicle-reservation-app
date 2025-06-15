<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelLog;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Vehicle $vehicle)
    {
        if ($vehicle->base_location_id !== Auth::user()->location_id) {
            abort(403, 'AKSES DITOLAK. ANDA TIDAK BERHAK MELIHAT DATA DARI LOKASI LAIN.');
        }
        $logs = $vehicle->fuelLogs()->latest('refuel_date')->paginate(10);
        return view('admin.fuel-logs.index', compact('vehicle', 'logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Vehicle $vehicle)
    {
        if ($vehicle->base_location_id !== Auth::user()->location_id) {
            abort(403, 'AKSES DITOLAK. ANDA TIDAK BERHAK MENGEDIT DATA DARI LOKASI LAIN.');
        }
        return view('admin.fuel-logs.create', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'refuel_date' => 'required|date',
            'liters_filled' => 'required|numeric|min:0.01',
            'cost' => 'nullable|numeric|min:0',
        ]);

        // Menggunakan relasi untuk membuat log baru, vehicle_id terisi otomatis
        $vehicle->fuelLogs()->create($request->all());

        $user = Auth::user();
        log_activity('CREATE_FUEL_LOG', "Admin {$user->id}  membuat catatan BBM untuk {$vehicle->id}");

        return redirect()->route('admin.vehicles.fuel-logs.index', $vehicle)
            ->with('success', 'Log BBM berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelLog $fuelLog)
    {
        $vehicle = $fuelLog->vehicle;
        if ($vehicle->base_location_id !== Auth::user()->location_id) {
            abort(403, 'AKSES DITOLAK. ANDA TIDAK BERHAK MENGEDIT DATA DARI LOKASI LAIN.');
        }
        return view('admin.fuel-logs.edit', compact('fuelLog', 'vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelLog $fuelLog)
    {
        $request->validate([
            'refuel_date' => 'required|date',
            'liters_filled' => 'required|numeric|min:0.01',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $fuelLog->update($request->all());
        $user = Auth::user();
        log_activity('UPDATE_FUEL_LOG', "Admin {$user->id} mengedit catatan BBM {$fuelLog->id}");

        return redirect()->route('admin.vehicles.fuel-logs.index', $fuelLog->vehicle)
            ->with('success', 'Log BBM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelLog $fuelLog)
    {
        $vehicle = $fuelLog->vehicle; 
        $fuelLog->delete();

        $user = Auth::user();
        log_activity('DELETE_FUEL_LOG', "Admin {$user->id} menghapus catatan BBM {$fuelLog->id}");


        return redirect()->route('admin.vehicles.fuel-logs.index', $vehicle)
            ->with('success', 'Log BBM berhasil dihapus.');
    }
}
