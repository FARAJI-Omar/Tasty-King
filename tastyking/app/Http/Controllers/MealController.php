<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function clientMenu()
    {
        $meals = Meal::paginate(12);
        $categories = Category::all();
        return view('menu', compact('meals', 'categories'));
    }
    public function chefMenu()
    {
        $meals = Meal::paginate(12)->withPath('');
        $categories = Category::all();
        return view('chef.menu-management', compact('meals', 'categories'));
    }
    public function adminMenu()
    {
        $meals = Meal::paginate(12);
        $categories = Category::all();
        return view('admin.menu-management', compact('meals', 'categories'));
    }

    public function createMeal(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category,id',
        ]);

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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:category,id',
        ]);

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

        // Delete the image file if it exists
        if ($meal->image && Storage::disk('public')->exists($meal->image)) {
            Storage::disk('public')->delete($meal->image);
        }

        // Delete the meal from the database
        $meal->delete();

        return redirect()->back()->with('success', 'Meal deleted successfully!');
    }
}
