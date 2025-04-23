<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $data['photo'] = $photoPath;
        }

        $user = User::create($data);

        Auth::login($user);

        return $this->loginRedirect();
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentals = $request->only('name', 'password');

        if (Auth::attempt($credentals)) {
            $request->session()->regenerate();

            return $this->loginRedirect();
        }
        return back()->withErrors([
            'login' => 'Invalid name or password'
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    protected function loginRedirect()
    {
        $user = Auth::user();

        if ($user->role === 'client') {
            return redirect()->route('menu');
        } elseif ($user->role === 'chef') {
            return redirect()->route('chef.menu-management');
        } elseif ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            abort(404, 'Role not recognized.');
        }
    }
}
