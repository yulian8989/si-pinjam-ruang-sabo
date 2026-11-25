<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{

    private function updateExpiredBookings()
    {
        $now = now();

        Booking::where('status', 'pending')
            ->where('start_time', '<', $now)
            ->update([
                'status' => 'expired',
                'admin_status' => 'expired' 
            ]);

        Booking::where('status', 'active')
            ->where('end_time', '<', $now)
            ->update(['status' => 'finished']);
    }
    public function index()
    {
        $this->updateExpiredBookings();

        $stats = [
   
            'pending_verification' => Booking::where('staff_status', 'pending')
                                            ->where('status', 'pending')
                                            ->count(),

            'total_processed'      => Booking::where('staff_status', '!=', 'pending')->count(),

            'today_incoming'       => Booking::whereDate('start_time', now())->count(),
        ];


        $pendingBookings = Booking::with(['user', 'room'])
            ->where('staff_status', 'pending')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('staff.dashboard', compact('stats', 'pendingBookings'));
    }
}
