<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function approve(Approval $approval)
    {
        // Keamanan: Pastikan yang menyetujui adalah orang yang tepat
        if ($approval->approver_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK.');
        }

        // Update status persetujuan ini
        $approval->update(['status' => 'approved', 'approved_at' => now()]);

        // Cek apakah semua level sudah menyetujui
        $allApproved = Approval::where('reservation_id', $approval->reservation_id)
                               ->where('status', '!=', 'approved')
                               ->doesntExist();

        if ($allApproved) {
            // Jika semua sudah setuju, update status reservasi utama
            $approval->reservation()->update(['status' => 'approved']);
        }

        return redirect()->route('approver.dashboard')->with('success', 'Reservasi berhasil disetujui.');
    }

    public function reject(Approval $approval)
    {
        // Keamanan: Pastikan yang menolak adalah orang yang tepat
        if ($approval->approver_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK.');
        }

        DB::transaction(function() use ($approval) {
            // Update status persetujuan ini menjadi ditolak
            $approval->update(['status' => 'rejected']);

            // Update status reservasi utama menjadi ditolak
            $reservation = $approval->reservation;
            $reservation->update(['status' => 'rejected']);

            // Kembalikan status kendaraan dan driver menjadi tersedia
            $reservation->vehicle()->update(['status' => 'available']);
            $reservation->driver()->update(['is_available' => true]);
        });

        return redirect()->route('approver.dashboard')->with('success', 'Reservasi telah ditolak.');
    }
}
