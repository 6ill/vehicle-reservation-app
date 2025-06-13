<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:drivers,phone_number',
            'is_available' => 'required|boolean',
        ]);

        Driver::create($request->all());

        return redirect()
        ->route('admin.drivers.index')                 
        ->with('success', 'Data driver berhasil ditambahkan.');
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:drivers,phone_number,' . $driver->id,
            'is_available' => 'required|boolean',
        ]);

        $driver->update($request->all());

        return redirect()
        ->route('admin.drivers.index')
        ->with('success', 'Data driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()
        ->route('admin.drivers.index')
        ->with('success', 'Data driver berhasil dihapus.');
    }
}
