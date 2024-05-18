<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'realtor_id' => 'required|exists:realtors,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        Review::create([
            'listing_id' => $request->listing_id,
            'user_id' => auth()->id(),
            'realtor_id' => $request->realtor_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}
