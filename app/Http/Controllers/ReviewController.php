<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user:id,name')->get(['rating', 'comment', 'user_id']);

        // Transform the reviews data to include user_name
        $transformedReviews = $reviews->map(function ($review) {
            return [
                'rating' => $review->rating,
                'comment' => $review->comment,
                'user_id' => $review->user_id,
                'user_name' => $review->user->name,
            ];
        });

        return response()->json([
            'reviews' => $transformedReviews
        ]);
    }

    

    public function store(Request $request, $id)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->user_id = $user->id;
        $review->book_id = $id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->created_at = Carbon::now();
        $review->updated_at = Carbon::now();
        $review->save();

        return response()->json([
            'message' => 'Review added successfully',
            'data' => $review
        ], 201);
    }

}
