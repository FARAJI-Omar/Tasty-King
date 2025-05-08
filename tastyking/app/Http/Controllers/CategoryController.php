<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $categoryName = $category->name;

        $mealsCount = $category->meals()->count();

        if ($mealsCount > 0) {
            $otherCategory = Category::firstOrCreate(
                ['name' => 'Other'],
                ['name' => 'Other']
            );

            if ($category->id === $otherCategory->id) {
                return redirect()->back()
                    ->with('error', 'Cannot delete the "Other" category!');
            }

            $category->meals()->update(['category_id' => $otherCategory->id]);

            $message = $mealsCount . ' meal(s) have been moved to the "Other" category.';
        } else {
            $message = 'No meals were affected.';
        }

        $category->delete();

        return redirect()->back()
            ->with('success', 'Category "' . $categoryName . '" has been deleted successfully! ' . $message);
    }
}
