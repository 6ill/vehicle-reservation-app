<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vehicles = Vehicle::with('baseLocation')->where('base_location_id', $user->location_id)->latest()->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'ownership' => 'required|in:company,rental',
            'status' => 'required|in:available,in_use,maintenance',
        ]);

        $user = Auth::user();
        Vehicle::create($request->all() + ['base_location_id' => $user->location_id]);

        $user = Auth::user();
        log_activity('CREATE_VEHICLE', "Admin {$user->id} menambahkan kendaraan {$request->name} {$request->license_plate}");

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }


    public function edit(Vehicle $vehicle)
    {
        if ($vehicle->base_location_id !== Auth::user()->location_id) {
            abort(403, 'AKSES DITOLAK. ANDA TIDAK BERHAK MENGEDIT DATA DARI LOKASI LAIN.');
        }
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'ownership' => 'required|in:company,rental',
            'status' => 'required|in:available,in_use,maintenance',
        ]);

        $vehicle->update($request->all());

        $user = Auth::user();
        log_activity('UPDATE_VEHICLE', "Admin {$user->id} mengedit kendaraan {$vehicle->name} {$vehicle->license_plate}");

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        $user = Auth::user();
        log_activity('DELETE_VEHICLE', "Admin {$user->id} menghapus kendaraan {$vehicle->name} {$vehicle->license_plate}");

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
