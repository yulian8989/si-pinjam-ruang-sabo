<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $unverifiedUsers = User::where('role', 'user')
        ->where('is_active', false)
        ->count();

        $activeUsers = User::where('role', 'user')
                       ->where('is_active', true)
                       ->count();

        $totalRooms = Room::count();
        $totalFacilities = Facility::count();
        $pendingBookings = Booking::where('admin_status', 'pending')->count();
        
        $today = Carbon::today();
        $todayBookings = Booking::with(['user', 'room'])
            ->whereDate('start_time', '<=', $today)
            ->whereDate('end_time', '>=', $today)
            ->where('admin_status', 'approved')
            ->get();

        return view('admin.dashboard', compact(
            'unverifiedUsers',
            'activeUsers',
            'totalRooms', 
            'totalFacilities', 
            'pendingBookings', 
            'todayBookings'
        ));
    }
}
