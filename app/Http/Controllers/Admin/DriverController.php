<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $user = Auth::user();
        log_activity('CREATE_DRIVER', "Admin {$user->id} menambah driver");

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

        $user = Auth::user();
        log_activity('UPDATE_DRIVER', "Admin {$user->id} mengedit driver {$driver->id}");

        return redirect()
        ->route('admin.drivers.index')
        ->with('success', 'Data driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        $user = Auth::user();
        log_activity('DELETE_DRIVER', "Admin {$user->id} menghapus driver {$driver->id}");

        return redirect()
        ->route('admin.drivers.index')
        ->with('success', 'Data driver berhasil dihapus.');
    }
}
