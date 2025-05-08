<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function createMeal(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meal-images', 'public');
        }

        Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Meal created successfully!');
    }

    public function updateMeal(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('meal_id', $id)->withInput();
        }

        $meal = Meal::findOrFail($id);

        $imagePath = $meal->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('meal-images', 'public');
        }

        $meal->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Meal updated successfully!');
    }

    public function deleteMeal($id)
    {
        $meal = Meal::findOrFail($id);

        if ($meal->image && Storage::disk('public')->exists($meal->image)) {
            Storage::disk('public')->delete($meal->image);
        }

        $meal->delete();

        return redirect()->back()->with('success', 'Meal deleted successfully!');
    }

    public function showItemDetails($id)
    {
        $meal = Meal::findOrFail($id);
        $reviews = Review::where('meal_id', $id)->get();
        return view('itemDetails', compact('meal', 'reviews'));
    }

    public function search($name)
    {
        $meals = Meal::where('name', 'LIKE', "%{$name}%")->get();
        
        return response()->json($meals);
    }
}
