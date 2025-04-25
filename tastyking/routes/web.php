<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CLientController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
        Route::get(('item-details/{id}'), [ClientController::class, 'showItemDetails'])->name('item-details');

        Route::get('cart', [CartController::class, 'index'])->name('cart');
        Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
        Route::delete('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::patch('update-cart/{id}', [CartController::class, 'updateQuantity'])->name('update-cart');

        Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('checkout', [CheckoutController::class, 'placeOrder'])->name('place-order');
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
        Route::get('admin/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');
        Route::get('admin/menu-management', [AdminController::class, 'adminMenu'])->name('menu-management');
        Route::delete('admin/delete-meal/{id}', [MealController::class, 'deleteMeal'])->name('admin-delete-meal');
        Route::put('admin/update-meal/{id}', [MealController::class, 'updateMeal'])->name('admin-update-meal');
        Route::get('admin/user-management', [AdminController::class, 'adminUsers'])->name('user-management');
        Route::post('admin/promote-to-chef', [AdminController::class, 'promoteToChef'])->name('promote-to-chef');
        Route::delete('admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
        Route::get('admin/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('admin/create-category', [AdminController::class, 'createCategory'])->name('create-category');
        Route::delete('admin/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('delete-category');
    });
});






Route::get('order-tracking', function () {
    return view('orderTracking');
})->name('order-tracking');
