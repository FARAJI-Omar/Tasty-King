<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {

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

    public function placeOrder(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:paypal,credit-card,cod',
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->first();

        $order->delivery_address = $request->address;
        $order->delivery_message = $request->message;
        $order->payment_method = $request->payment_method;
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $meal = Meal::find($item->meal_id);
            if ($meal) {
                $meal->order_count += 1;
                $meal->save();
            }
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('order.success');
    }
}
