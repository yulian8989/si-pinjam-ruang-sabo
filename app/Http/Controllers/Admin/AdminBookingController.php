<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index()
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

        $bookings = Booking::with(['user', 'room'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $rooms = Room::where('is_active', true)->get();
        
        return view('admin.bookings.edit', compact('booking', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // 1. Validasi disesuaikan dengan nama kolom 'notes'
        $request->validate([
            'staff_status'  => 'required|in:pending,approved,rejected',
            'admin_status'  => 'required|in:pending,approved,rejected',
            'status'        => 'required|in:pending,active,finished,rejected,cancelled,expired',
            'notes'         => 'nullable|string' 
        ]);

        // 2. Simpan Perubahan Status
        $booking->update([
            'staff_status'  => $request->staff_status,
            'admin_status'  => $request->admin_status,
            'status'        => $request->status,
            // Simpan alasan HANYA jika status ditolak
            'notes'         => $request->status == 'rejected' ? $request->notes : null,
        ]);

        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Status peminjaman berhasil diperbarui.');
    }
    public function reject(Request $request, $id)
    {
        // Validasi menangkap input 'notes' dari Modal
        $request->validate(['notes' => 'required|string']);
        
        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'admin_status' => 'rejected',
            'status'       => 'rejected',
            'notes'        => $request->notes // Simpan ke database
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function approve($id) 
    {
        $booking = Booking::findOrFail($id);


        if ($booking->start_time < now() && $booking->status == 'pending') {
            $booking->update(['status' => 'expired', 'admin_status' => 'expired']);
            return redirect()->back()->with('error', 'Peminjaman kadaluarsa.');
        }

        $booking->admin_status = 'approved';
        $booking->save();

        if ($booking->admin_status == 'approved' && $booking->staff_status == 'approved') {
            $booking->update(['status' => 'active']);
        }

        return redirect()->back()->with('success', 'Berkas berhasil diverifikasi oleh Admin.');
    }

    public function downloadReport()
    {

        $bookings = Booking::with(['user', 'room'])
                    ->whereIn('status', ['active', 'finished'])
                    ->latest()
                    ->get();

        $data = [
            'title' => 'Laporan Peminjaman Ruangan Balai Teknik Sabo',
            'date' => date('d/m/Y'),
            'bookings' => $bookings
        ];

        $pdf = Pdf::loadView('admin.bookings.report-pdf', $data)
                  ->setPaper('a4', 'landscape'); 

        return $pdf->download('laporan-peminjaman-' . date('d-m-Y') . '.pdf');
    }
}