<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceHistory;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceHistoryController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        $histories = $vehicle->serviceHistory()->latest('service_date')->paginate(10);
        return view('admin.service-history.index', compact('vehicle', 'histories'));
    }

    public function create(Vehicle $vehicle)
    {
        return view('admin.service-history.create', compact('vehicle'));           
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'service_date' => 'required|date',
            'service_details' => 'required|string',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $vehicle->serviceHistory()->create($request->all());

        return redirect()->route('admin.vehicles.service-history.index', $vehicle)
            ->with('success', 'Catatan servis berhasil ditambahkan.');
    }

    public function edit(ServiceHistory $serviceHistory)
    {
        $vehicle = $serviceHistory->vehicle;
        return view('admin.service-history.edit', compact('serviceHistory', 'vehicle'));
    }

    public function update(Request $request, ServiceHistory $serviceHistory)
    {
         $request->validate([
            'service_date' => 'required|date',
            'service_details' => 'required|string',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $serviceHistory->update($request->all());

        return redirect()->route('admin.vehicles.service-history.index', $serviceHistory->vehicle)
            ->with('success', 'Catatan servis berhasil diperbarui.');
    }

    public function destroy(ServiceHistory $serviceHistory)
    {
        $vehicle = $serviceHistory->vehicle;
        $serviceHistory->delete();

        return redirect()->route('admin.vehicles.service-history.index', $vehicle)
            ->with('success', 'Catatan servis berhasil dihapus.');
    }
}
