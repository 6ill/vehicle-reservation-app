<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('baseLocation')->latest()->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.vehicles.create', compact('locations'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'ownership' => 'required|in:company,rental',
            'status' => 'required|in:available,in_use,maintenance',
            'base_location_id' => 'required|exists:locations,id',
        ]);

        Vehicle::create($request->all());

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }


    public function edit(Vehicle $vehicle)
    {
        $locations = Location::all();
        return view('admin.vehicles.edit', compact('vehicle', 'locations'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'type' => 'required|in:angkutan_orang,angkutan_barang',
            'ownership' => 'required|in:company,rental',
            'status' => 'required|in:available,in_use,maintenance',
            'base_location_id' => 'required|exists:locations,id',
        ]);

        $vehicle->update($request->all());

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()
        ->route('admin.vehicles.index')
        ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
