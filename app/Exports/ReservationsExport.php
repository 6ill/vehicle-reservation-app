<?php

namespace App\Exports;

use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        $query = Reservation::with(['requester', 'vehicle', 'driver', 'approvals.approver'])
                            ->whereIn('status', ['approved', 'completed', 'rejected']); // Hanya ekspor yang disetujui/selesai

        if ($this->startDate) {
            $query->whereDate('start_datetime', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('start_datetime', '<=', $this->endDate);
        }
        Log::debug('count: ' . $query->count());
        return $query->orderBy('start_datetime', 'asc');
    }

    public function headings(): array
    {
        return [
            'ID Reservasi',
            'Pemesan',
            'Kendaraan',
            'No. Polisi',
            'Driver',
            'Keperluan',
            'Waktu Mulai',
            'Waktu Selesai',
            'Status',
            'Penyetuju Lvl. 1',
            'Penyetuju Lvl. 2',
        ];
    }

    public function map($reservation): array
    {
        $approver1 = $reservation->approvals->where('level', 1)->first()?->approver?->name ?? 'N/A';
        $approver2 = $reservation->approvals->where('level', 2)->first()?->approver?->name ?? 'N/A';

        return [
            $reservation->id,
            $reservation->requester->name, 
            $reservation->vehicle->name,
            $reservation->vehicle->license_plate,
            $reservation->driver->name,
            $reservation->purpose,
            \Carbon\Carbon::parse($reservation->start_datetime)->format('d-m-Y H:i'),
            \Carbon\Carbon::parse($reservation->end_datetime)->format('d-m-Y H:i'),
            ucfirst($reservation->status),
            $approver1,
            $approver2,
        ];
    }
}
