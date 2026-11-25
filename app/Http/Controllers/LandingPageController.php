<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landing()
    {
        $featuredRooms = Room::where('is_active', true)->with('facilities')->get();
        
        $bookings = Booking::with(['room', 'user'])
                           ->whereIn('status', ['active', 'finished'])
                           ->get();
        $events = [];

        foreach ($bookings as $booking) {

            if (!$booking->room || !$booking->user) continue;

            $isPast = Carbon::parse($booking->end_time)->isPast();

            $events[] = [
                'title' => $booking->room->name . ' (' . $booking->user->name . ')',
                'start' => $booking->start_time,
                'end'   => $booking->end_time,

                'color' => $isPast ? '#6c757d' : '#0d6efd', 
                'extendedProps' => [
                    'purpose' => $booking->purpose ?? 'Tidak ada keterangan'
                ]
            ];
        }

        return view('landingpage.landing', compact('featuredRooms', 'events'));
    }

    public function show($id)
    {
        $room = Room::with(['facilities', 'reviews.user'])->findOrFail($id);
        
        return view('landingpage.room-detail', compact('room'));
    }
}