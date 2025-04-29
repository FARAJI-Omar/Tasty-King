<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showDashboard()
    {
        $totalRevenue = Order::sum('total');
        $popularItems = Meal::orderBy('order_count', 'desc')->take(5)->get();
        $totalMeals = Meal::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $activeUsers = User::where('status', 'active')->count();
        $active = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0;

        $weeklyRevenueData = $this->getWeeklyRevenueData();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMeals',
            'active',
            'totalOrders',
            'popularItems',
            'totalRevenue',
            'weeklyRevenueData'
        ));
    }

    /**
     * Get the revenue data for the last 7 days
     *
     * @return array
     */
    private function getWeeklyRevenueData()
    {
        $today = Carbon::today();
        $startDate = $today->copy()->subDays(6);

        $dates = [];
        $revenues = [];
        $labels = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dates[] = $date->format('Y-m-d');
            $labels[] = $date->format('D');
        }

        foreach ($dates as $date) {
            $dailyRevenue = Order::whereDate('created_at', $date)->sum('total');
            $revenues[] = $dailyRevenue;
        }

        return [
            'labels' => $labels,
            'revenues' => $revenues
        ];
    }

    public function adminMenu(Request $request)
    {
        $categoryId = $request->query('category');

        $mealsQuery = Meal::query();

        if ($categoryId && $categoryId != 'all') {
            $mealsQuery->where('category_id', $categoryId);
        }

        $meals = $mealsQuery->paginate(12)->withQueryString();
        $categories = Category::all();
        $selectedCategory = $categoryId;

        return view('admin.menu-management', compact('meals', 'categories', 'selectedCategory'));
    }

    public function adminUsers()
    {
        $chefs = User::where('role', 'chef')->get();
        $clients = User::where('role', 'client')->get();
        return view('admin.user-management', compact('chefs', 'clients'));
    }

    public function promoteToChef(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->client_id);
        $user->role = 'chef';
        $user->save();

        return redirect()->route('user-management')->with('success', $user->name . ' has been promoted to chef successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('user-management')->with('success', $userName . ' has been deleted successfully!');
    }

    public function settings()
    {
        $categories = Category::all();
        return view('admin.settings', compact('categories'));
    }

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
