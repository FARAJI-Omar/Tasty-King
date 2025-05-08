<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    public function chefMenu(Request $request)
    {
        $categoryId = $request->query('category');

        $mealsQuery = Meal::query();

        if ($categoryId && $categoryId != 'all') {
            $mealsQuery->where('category_id', $categoryId);
        }

        $meals = $mealsQuery->paginate(12)->withQueryString();
        $categories = Category::all();
        $selectedCategory = $categoryId;

        return view('chef.menu-management', compact('meals', 'categories', 'selectedCategory'));
    }

    public function ordersManagement(Request $request)
    {
        $statusFilter = $request->query('status');
        $validStatuses = ['waiting', 'delivered', 'cancelled'];

        // Get today's date range
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();

        $ordersQuery = Order::with('user')
            ->whereIn('status', $validStatuses)
            ->whereBetween('created_at', [$today, $tomorrow])
            ->orderBy('created_at', 'desc');

        if ($statusFilter && $statusFilter != 'all') {
            $ordersQuery->where('status', $statusFilter);
        }

        $orders = $ordersQuery->paginate(10)->withQueryString();
        $selectedStatus = $statusFilter;
        $todayDate = now()->format('F d, Y');

        return view('chef.orders-management', compact('orders', 'selectedStatus', 'todayDate'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order #' . $order->id . ' status updated to ' . ucfirst($order->status));
    }
}
