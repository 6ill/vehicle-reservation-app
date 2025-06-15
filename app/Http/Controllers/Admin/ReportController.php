<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReservationsExport;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query()->with(['requester', 'vehicle', 'driver']);

        if ($request->filled('start_date')) {
            $query->whereDate('start_datetime', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('start_datetime', '<=', $request->end_date);
        }

        $reservations = $query->latest()->paginate(15);
        
        return view('admin.reports.reservations', compact('reservations'));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $filename = 'Laporan_Reservasi_' . Carbon::now()->format('d-m-Y') . '.xlsx';
        
        return Excel::download(new ReservationsExport($startDate, $endDate), $filename);
    }
}
