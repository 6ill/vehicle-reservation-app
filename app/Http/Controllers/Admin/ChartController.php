<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
     public function reservationData()
    {
        $reservationsByMonth = Reservation::select(
            DB::raw("COUNT(*) as count"), 
            DB::raw("TO_CHAR(start_datetime, 'YYYY-MM') as month")
        )
            ->where('start_datetime', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $labels[] = $month->format('M Y');

            $reservation = $reservationsByMonth->firstWhere('month', $monthKey);
            $data[] = $reservation ? $reservation->count : 0;
        }

        $reservationsByType = Reservation::with('vehicle')
            ->where('status', 'completed')
            ->get()
            ->groupBy('vehicle.type', true)
            ->map(fn ($group) => $group->count());

        return response()->json([
            'monthlyReservations' => [
                'labels' => $labels,
                'data' => $data,
            ],
            'reservationsByType' => [
                'labels' => $reservationsByType->keys(),
                'data' => $reservationsByType->values(),
            ]
        ]);
    }
}
