<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function adminMenu()
    {
        $meals = Meal::paginate(12);
        $categories = Category::all();
        return view('admin.menu-management', compact('meals', 'categories'));
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
}
