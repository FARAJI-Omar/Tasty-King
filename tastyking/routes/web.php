<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;






Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication Routes
Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [ClientAuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [ClientAuthController::class, 'register'])->name('register');





Route::get('menu', function () {
    return view('menu');
})->name('menu');

Route::get('item-details', function () {
    return view('itemDetails');
})->name('item-details');

Route::get('cart', function () {
    return view('cart');
})->name('cart');

Route::get('checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('order-tracking', function () {
    return view('orderTracking');
})->name('order-tracking');

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('admin/menu-management', function () {
    return view('admin.menu-management');
})->name('menu-management');

Route::get('admin/user-management', function () {
    return view('admin.user-management');
})->name('user-management');

Route::get('admin/settings', function () {
    return view('admin.settings');
})->name('settings');




Route::get('chef/menu-management', function () {
    return view('chef.menu-management');
})->name('chef-menu-management');
