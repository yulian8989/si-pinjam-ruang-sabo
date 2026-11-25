<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException; 
use App\Models\Booking;
use App\Models\Review;

class HistoryController extends Controller
{

    public function index() {
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

       
        $bookings = Booking::with(['room', 'review'])
            ->where('user_id', $userId)
            ->whereIn('status', ['finished', 'rejected', 'expired', 'cancelled'])
            ->latest()
            ->get();

        return view('user.history.index', compact('bookings'));
    }


    public function createReview($id) {

        $booking = Booking::with('room')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if ($booking->status !== 'finished') {
            return redirect()->route('user.history.index')
                             ->with('error', 'Maaf, ulasan hanya tersedia untuk peminjaman yang telah selesai (Finished).');
        }

        $existingReview = Review::where('booking_id', $id)->first();
        if ($existingReview) {
            return redirect()->route('user.history.index')
                             ->with('error', 'Anda sudah memberikan ulasan untuk peminjaman ini.');
        }

        return view('user.history.review', compact('booking'));
    }

    public function storeReview(Request $request) {
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'rating'     => 'required|integer|min:1|max:5',
        'comment'    => 'required|string|min:5|max:500',
    ]);

    $booking = Booking::where('id', $request->booking_id)
        ->where('user_id', auth()->id())
        ->where('status', 'finished')
        ->firstOrFail();

    if (Review::where('booking_id', $booking->id)->exists()) {
        return redirect()->route('user.history.index')
            ->with('error', 'Anda sudah memberikan ulasan untuk peminjaman ini.');
    }

    try {
        Review::create([
            'booking_id' => $booking->id,
            'user_id'    => auth()->id(),
            'room_id'    => $booking->room_id,   // dari booking, bukan request
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);
    } catch (QueryException $e) {
        return redirect()->route('user.history.index')
            ->with('error', 'Anda sudah memberikan ulasan untuk peminjaman ini.');
    }

    return redirect()->route('user.history.index')
        ->with('success', 'Terima kasih! Ulasan Anda sangat berarti bagi Balai Teknik Sabo.');
    }


    public function show($id)
    {
 
        $booking = Booking::with(['room', 'review'])
                                      ->where('user_id', auth()->id())
                                      ->findOrFail($id);

        return view('user.history.show', compact('booking'));
    }
}