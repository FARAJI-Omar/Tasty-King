<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meal,id',
            'description' => 'nullable|string|max:500',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::id();
        $mealId = $request->meal_id;

        $meal = Meal::findOrFail($mealId);
        $allReviews = $meal->reviews;

        // Create new review
        $review = new Review();
        $review->meal_id = $mealId;
        $review->user_id = $userId;
        $review->description = $request->description;
        $review->stars = $request->stars;

        // Calculate average
        if ($allReviews->count() > 0) {
            $totalStars = $allReviews->sum('stars') + $request->stars;
            $average = $totalStars / ($allReviews->count() + 1);
        } else {
            $average = $request->stars;
        }

        $review->average = $average;
        $review->save();

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
