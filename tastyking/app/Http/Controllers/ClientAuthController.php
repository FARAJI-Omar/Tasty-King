<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientAuthController extends Controller
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
            'email' => 'required|email|unique:clients',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile-photos', 'public');
            $data['photo'] = $photoPath;
        } else {
            $data['photo'] = 'images/profile.png';
        }

        $client = Client::create($data);

        // Log the user in after registration
        Auth::guard('client')->login($client);

        return redirect()->route('menu');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentals = $request->only('name', 'password');

        if (Auth::guard('client')->attempt($credentals)) {
            $request->session()->regenerate();

            return redirect('/menu');
        }
        return back()->withErrors([
            'login' => 'Invalid name or password'
        ])->withInput();
    }

    public function logout(){
        Auth::guard('client')->logout();
        return redirect('/login');
    }
}
