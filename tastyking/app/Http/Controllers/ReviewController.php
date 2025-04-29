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

        $review = new Review();
        $review->meal_id = $request->meal_id;
        $review->user_id = Auth::id();
        $review->description = $request->description;
        $review->stars = $request->stars;
        
        $meal = Meal::findOrFail($request->meal_id);
        $existingReviews = $meal->reviews;
        
        if ($existingReviews->count() > 0) {
            $totalStars = $existingReviews->sum('stars') + $request->stars;
            $average = $totalStars / ($existingReviews->count() + 1);
        } else {
            $average = $request->stars;
        }
        
        $review->average = $average;
        $review->save();

        return redirect()->back()->with('success', 'Thank you for your review!');
    }

}
