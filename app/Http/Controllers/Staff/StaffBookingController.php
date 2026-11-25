<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class StaffBookingController extends Controller
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

        $bookings = Booking::with(['user', 'room'])->latest()->get();
        return view('staff.bookings.index', compact('bookings'));
    }

    public function approve($id) 
    {
        $booking = Booking::findOrFail($id);

        if ($booking->start_time < now() && $booking->status == 'pending') {
            $booking->update(['status' => 'expired', 'staff_status' => 'expired']);
            return redirect()->back()->with('error', 'Peminjaman kadaluarsa.');
        }


        $booking->staff_status = 'approved';
        $booking->save();


        if ($booking->admin_status == 'approved' && $booking->staff_status == 'approved') {
            $booking->update(['status' => 'active']);
        }

        return redirect()->back()->with('success', 'Peminjaman diverifikasi oleh Staff.');
    }

    public function reject(Request $request, $id) 
    {
        $request->validate([
            'notes' => 'required|string|max:500'
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->start_time < now() && $booking->status == 'pending') {
            $booking->update(['status' => 'expired', 'staff_status' => 'expired']);
            return redirect()->route('staff.bookings.index')->with('error', 'Peminjaman kadaluarsa.');
        }

        $booking->update([
            'staff_status' => 'rejected',
            'status'       => 'rejected',
            'notes'        => $request->notes 
        ]);
        return redirect()->route('staff.bookings.index')->with('success', 'Peminjaman berhasil ditolak.');
    }

}