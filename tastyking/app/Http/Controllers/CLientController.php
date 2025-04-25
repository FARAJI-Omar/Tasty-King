<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Meal;
use Illuminate\Support\Facades\Storage;

class CLientController extends Controller
{
    public function showProfile()
    {
        return view('profile');
    }

    public function editPersonalInfo(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $updateData = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $updateData['photo'] = $photoPath;
        }

        User::where('id', $user->id)->update($updateData);

        return redirect()->back()->with('success', 'Personal information updated successfully.');
    }

    public function editPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput();
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'The password is incorrect.'])
                ->withInput()
                ->with('show_delete_modal', true);
        }

        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        User::where('id', $user->id)->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Your account has been permanently deleted.');
    }

    public function showItemDetails($id)
    {
        $meal = Meal::findOrFail($id);
        return view('itemDetails', compact('meal'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meal,id',
            'size' => 'required|in:small,regular,large',
            'quantity' => 'required|integer|min:1'
        ]);

        // Get existing cart or create empty array
        $cart = session()->get('cart', []);

        // Get meal details
        $meal = Meal::findOrFail($request->meal_id);

        // Add new item to cart
        $cart[] = [
            'id' => $meal->id,
            'name' => $meal->name,
            'price' => $meal->price,
            'image' => $meal->image,
            'size' => $request->size,
            'quantity' => $request->quantity
        ];

        // Save cart back to session
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', $meal->name . ' added to cart!');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|min:0'
        ]);

        $index = $request->index;
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            $itemName = $cart[$index]['name'];

            // Remove the item from the cart
            array_splice($cart, $index, 1);

            // Update the cart in the session
            session()->put('cart', $cart);

            return redirect()->route('cart')->with('success', $itemName . ' removed from cart!');
        }

        return redirect()->route('cart')->with('error', 'Item not found in cart!');
    }
}
