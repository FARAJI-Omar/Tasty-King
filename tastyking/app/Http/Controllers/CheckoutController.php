<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateOrderStatusJob;
use App\Jobs\GeneratePDFJob;
use App\Models\Cart;
use App\Models\Meal;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('menu')->with('error', 'Your cart is empty. Please add items before checkout.');
        }

        // Check for existing order in session
        if ($request->session()->has('checkout_order_id')) {
            $order = Order::find($request->session()->get('checkout_order_id'));
            if ($order && $order->user_id == Auth::id() && !$order->delivery_address) {
                $total = $order->total;
                return view('checkout', compact('total', 'order'));
            }
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

        // Store order ID in session
        $request->session()->put('checkout_order_id', $order->id);

        return view('checkout', compact('total', 'order'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:cod',
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->first();

        // Check if order already has a delivery address (already processed)
        if ($order && $order->delivery_address) {
            return redirect()->route('order-tracking');
        }

        $order->delivery_address = $request->address;
        $order->delivery_message = $request->message;
        $order->payment_method = $request->payment_method;
        $order->save();

        // Clear the checkout order ID from session
        $request->session()->forget('checkout_order_id');

        UpdateOrderStatusJob::dispatch($order->id)->delay(now()->addSeconds(5));

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $meal = Meal::find($item->meal_id);
            if ($meal) {
                $meal->order_count += 1;
                $meal->save();
            }
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('order-tracking');
    }

    public function generatePDF($id)
    {
        $order = Order::findorFail($id);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('orderPDF', $data);
        $date = Carbon::now()->format('Y-m-d H:i');
        return $pdf->download('TastyKing-order-' . $order->id . '-' . $date . '.pdf');
    }
}
