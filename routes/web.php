<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Authentication;


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('user.home');
})->name('user.home');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [Authentication::class, 'auth'])->name('login.auth');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegistrationController::class, 'register'])->name('register.store');

Route::get(('/products'), function () {
    $controller = new ProductController();
    $products = $controller->getAllProduct();
    return view('products', compact('products'));
})->name('products');

Route::get('/add-product', function () {
    return view('addProduct');
})->name('add-product');

Route::post('/add-product', [ProductController::class, 'store'])->name('product.store');

Route::get('/users', function () {
    $controller = new UserController();
    $users = $controller->getAllUser();
    return view('users', compact('users'));
})->name('users');