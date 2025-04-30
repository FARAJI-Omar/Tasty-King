<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('orderTracking');
    }

    public function success()
    {
        return view('orderSuccess');
    }

    public function orderTracking()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orderTracking', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $order->status = 'received';
        $order->save();

        return redirect()->back()->with('success', 'Order ' . $order->id . ' marked as received successfully');
    }
}
