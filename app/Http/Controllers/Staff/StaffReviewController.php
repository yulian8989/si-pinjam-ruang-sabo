<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class StaffReviewController extends Controller
{
    public function index()
    {

        $reviews = Review::with(['user', 'room'])->latest()->paginate(10);
        
        return view('staff.reviews.index', compact('reviews'));
    }
}
