<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CLientController;
use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleClient;
use App\Http\Middleware\RoleChef;
use App\Http\Middleware\RoleAdmin;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// authentication routes
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login');
Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register');

// require auth
Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

    // client routes
    Route::middleware(RoleClient::class)->group(function () {
        Route::get('menu', [MealController::class, 'clientMenu'])->name('menu');

        Route::get('profile', [CLientController::class, 'showProfile'])->name('profile');
        Route::put('profile/update-info', [CLientController::class, 'editPersonalInfo'])->name('profile.update-info');
        Route::put('profile/update-password', [CLientController::class, 'editPassword'])->name('profile.update-password');
        Route::delete('profile/delete-account', [CLientController::class, 'deleteAccount'])->name('profile.delete-account');
    });

    // chef routes
    Route::middleware(RoleChef::class)->group(function () {
        Route::get('chef/menu-management', [MealController::class, 'chefMenu'])->name('chef.menu-management');
        Route::post('chef/create-meal', [MealController::class, 'createMeal'])->name('create-meal');
        Route::put('chef/update-meal/{id}', [MealController::class, 'updateMeal'])->name('update-meal');
        Route::delete('chef/delete-meal/{id}', [MealController::class, 'deleteMeal'])->name('delete-meal');
    });

    // admin routes
    Route::middleware(RoleAdmin::class)->group(function () {
        Route::get('admin/menu-management', [MealController::class, 'adminMenu'])->name('menu-management');

        Route::delete('admin/delete-meal/{id}', [MealController::class, 'deleteMeal'])->name('admin-delete-meal');
        Route::put('admin/update-meal/{id}', [MealController::class, 'updateMeal'])->name('admin-update-meal');


    });
});



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


Route::get('admin/user-management', function () {
    return view('admin.user-management');
})->name('user-management');

Route::get('admin/settings', function () {
    return view('admin.settings');
})->name('settings');
