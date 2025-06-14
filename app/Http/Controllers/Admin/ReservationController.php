<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['requester', 'vehicle', 'driver'])->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();
        $vehicles = Vehicle::where('status', 'available')->orderBy('name')->get();
        $drivers = Driver::where('is_available', true)->orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        return view('admin.reservations.create', compact('employees', 'vehicles', 'drivers', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'requester_id' => 'required|exists:employees,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_location_id' => 'required|exists:locations,id',
            'destination' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'purpose' => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $employee = Employee::find($request->requester_id);
                $level1Approver = $employee->superior; 
                $level2Approver = $level1Approver ? $level1Approver->superior : null; // Nini

                if (!$level1Approver || !$level2Approver) {
                    throw new \Exception('Struktur persetujuan untuk pegawai ini tidak lengkap.');
                }

                $reservation = Reservation::create([
                    'requester_id' => $request->requester_id,
                    'vehicle_id' => $request->vehicle_id,
                    'driver_id' => $request->driver_id,
                    'start_location_id' => $request->start_location_id,
                    'destination' => $request->destination,
                    'start_datetime' => $request->start_datetime,
                    'end_datetime' => $request->end_datetime,
                    'purpose' => $request->purpose,
                    'status' => 'pending',
                    'created_by_admin_id' => Auth::id(),
                ]);

                Approval::create([
                    'reservation_id' => $reservation->id,
                    'approver_id' => $level1Approver->id,
                    'level' => 1,
                    'status' => 'pending',
                ]);

                Approval::create([
                    'reservation_id' => $reservation->id,
                    'approver_id' => $level2Approver->id,
                    'level' => 2,
                    'status' => 'pending',
                ]);

                // d. Update status kendaraan dan driver
                Vehicle::find($request->vehicle_id)->update(['status' => 'in_use']);
                Driver::find($request->driver_id)->update(['is_available' => false]);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('admin.reservations.index')->with('success', 'Reservasi berhasil dibuat dan menunggu persetujuan.');
    }

    public function markAsCompleted(Reservation $reservation)
    {
        if ($reservation->status !== 'approved') {
            return redirect()->route('admin.reservations.index')->with('error', 'Hanya reservasi yang disetujui yang bisa diselesaikan.');
        }

        try {
            DB::transaction(function () use ($reservation) {
                $reservation->update(['status' => 'completed']);

                $reservation->vehicle()->update(['status' => 'available']);

                $reservation->driver()->update(['is_available' => true]);
            });
        } catch (\Exception $e) {
            return redirect()->route('admin.reservations.index')->with('error', 'Gagal menyelesaikan reservasi: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.reservations.index')->with('success', 'Reservasi telah ditandai selesai.');
    }
}
