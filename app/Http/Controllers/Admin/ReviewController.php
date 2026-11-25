<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {

        $reviews = Review::with(['user', 'room'])->latest()->get();
        

        $averageRating = Review::avg('rating');
        $totalReviews = Review::count();

        return view('admin.reviews.index', compact('reviews', 'averageRating', 'totalReviews'));
    }

    public function destroy(Review $review)
    {

        $review->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
