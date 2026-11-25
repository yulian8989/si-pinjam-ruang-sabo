<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $now = now();

       
        Booking::where('user_id', $userId)->where('status', 'pending')->where('start_time', '<', $now)->update(['status' => 'expired']);
        Booking::where('user_id', $userId)->where('status', 'active')->where('end_time', '<', $now)->update(['status' => 'finished']);
        
        $stats = [
            'total'    => Booking::where('user_id', $userId)->count(),
            'pending'  => Booking::where('user_id', $userId)->where('status', 'pending')->count(),
            'active'   => Booking::where('user_id', $userId)->where('status', 'active')->count(),
            'finished' => Booking::where('user_id', $userId)->where('status', 'finished')->count(), 
        ];

        $recentBookings = Booking::with('room')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact('stats', 'recentBookings'));
    }
}
