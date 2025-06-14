<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() 
    {
        $userId = Auth::id();

        $pendingApprovals = Approval::with(['reservation.requester', 'reservation.vehicle'])
            ->where('approver_id', $userId)
            ->where('status', 'pending')
            ->get();
            
        $actionableApprovals = $pendingApprovals->filter(function ($approval) {
            if ($approval->level === 1) {
                return true;
            }
            
            if ($approval->level === 2) {
                $level1Approved = Approval::where('reservation_id', $approval->reservation_id)
                                    ->where('level', 1)
                                    ->where('status', 'approved')
                                    ->exists();
                return $level1Approved;
            }

            return false;
        });

        return view('approver.dashboard', ['approvals' => $actionableApprovals]);
    }
}
