<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();

            foreach ($cartItems as $item) {
                $subtotal += $item->meal_price * $item->quantity;
            }
        }

        return view('cart', compact('cartItems', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meal,id',
            'size' => 'required|in:small,regular,big',
            'quantity' => 'required|integer|min:1'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        $meal = Meal::findOrFail($request->meal_id);

        // Check if this meal with the same size already exists in cart
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('meal_id', $meal->id)
            ->where('size', $request->size)
            ->first();

        if ($existingCartItem) {
            // Update quantity if item already exists
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'meal_id' => $meal->id,
                'meal_name' => $meal->name,
                'meal_price' => $meal->price,
                'meal_image' => $meal->image,
                'size' => $request->size,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart')->with('success', $meal->name . ' added to cart!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id != Auth::id()) {
            return redirect()->route('cart')->with('error', 'You are not authorized to remove this item');
        }

        $mealName = $cartItem->meal_name;
        $cartItem->delete();

        return redirect()->route('cart')->with('success', $mealName . ' removed from cart!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id != Auth::id()) {
            return redirect()->route('cart')->with('error', 'You are not authorized to update this item');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }

        return 0;
    }
}
