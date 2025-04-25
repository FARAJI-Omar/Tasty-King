<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty. Please add items before checkout.');
        }

        $subtotal = 0;
        $itemsData = [];

        foreach ($cartItems as $item) {
            $itemTotal = $item->meal_price * $item->quantity;
            $subtotal += $itemTotal;

            $itemsData[] = [
                'meal_id' => $item->meal_id,
                'meal_name' => $item->meal_name,
                'meal_price' => $item->meal_price,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'subtotal' => $itemTotal
            ];
        }

        $total = $subtotal + 20;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'waiting',
            'items_data' => json_encode($itemsData)
        ]);

        return view('checkout', compact('total', 'order'));
    }

}
