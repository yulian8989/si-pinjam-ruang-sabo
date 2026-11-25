<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_active', true)->with('facilities')->get();
        
        return view('user.rooms.index', compact('rooms'));
    }

    public function create(Request $request)
    {
        $roomId = $request->query('room_id');

        $room = Room::with('facilities')->where('is_active', true)->findOrFail($roomId);
        
        $upcomingBookings = \App\Models\Booking::where('room_id', $roomId)
            ->whereIn('status', ['active', 'finished']) 
            ->where('start_time', '>=', now())         
            ->orderBy('start_time', 'asc')              
            ->take(5)                                   
            ->get();
        return view('user.bookings.create', compact('room', 'upcomingBookings'));
    }

    public function store(Request $request)
    {
        $fullStartTime = $request->booking_date . ' ' . $request->start_time;
        $fullEndTime   = $request->booking_date . ' ' . $request->end_time;

        $request->merge([
            'start_time' => $fullStartTime,
            'end_time'   => $fullEndTime,
        ]);


        $request->validate([
            'room_id'      => 'required|exists:rooms,id',

            'booking_date' => 'required|date|after_or_equal:today', 

            'start_time'   => 'required|date|after:now', 

            'end_time'     => 'required|date|after:start_time', 
            'purpose'      => 'required|string|min:10',
            'attachment'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', 
        ], [
            'booking_date.after_or_equal' => 'Tanggal peminjaman tidak boleh lewat.',
            'start_time.after' => 'Waktu mulai sudah terlewat (harus lebih dari waktu sekarang).',
            'end_time.after'   => 'Jam selesai harus lebih akhir dari jam mulai.',
            'attachment.max'   => 'Ukuran berkas maksimal adalah 2MB.',
        ]);


        $isBooked = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->where('start_time', '<', $request->end_time)
                      ->where('end_time', '>', $request->start_time);
            })
            ->whereIn('status', ['pending', 'active']) 
            ->exists();

        if ($isBooked) {
            return back()
                ->withInput()
                ->with('error', 'Maaf, ruangan sudah dipesan pada jam tersebut. Silakan pilih jam lain.');
        }


        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        Booking::create([
            'user_id'       => auth()->id(),
            'room_id'       => $request->room_id,
            'start_time'    => $request->start_time, 
            'end_time'      => $request->end_time,   
            'purpose'       => $request->purpose,
            'attachment'    => $attachmentPath, 
            'staff_status'  => 'pending',
            'admin_status'  => 'pending',
            'status'        => 'pending', 
        ]);

        return redirect()->route('user.bookings.index') 
                         ->with('success', 'Permohonan berhasil dikirim. Silakan pantau status verifikasi berkas.');
    }
    public function cancel($id)
    {
        $booking = Booking::where('user_id', auth()->id())->findOrFail($id);

        if (in_array($booking->status, ['finished', 'rejected', 'expired', 'cancelled'])) {
            return back()->with('error', 'Peminjaman ini sudah tidak dapat dibatalkan.');
        }
    
        $booking->update([
            'status' => 'cancelled'
        ]);
            return redirect()->route('user.bookings.index')
                         ->with('success', 'Peminjaman ruangan berhasil dibatalkan.');
    }
    public function myBookings() {
        $now = now();
        $userId = auth()->id();

        Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->where('start_time', '<', $now)
            ->update(['status' => 'expired']);

        Booking::where('user_id', $userId)
        ->where('status', 'active')
        ->where('end_time', '<', $now)
        ->update(['status' => 'finished']);

        $bookings = Booking::where('user_id', $userId)
            ->whereIn('status', ['pending', 'active']) 
            ->where('end_time', '>=', $now)
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }
}
