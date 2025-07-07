<?php

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

Route::get(('/products'), function () {
    return view('products');
})->name('products');

Route::get('/add-product', function () {
    return view('addProduct');
})->name('add-product');

Route::get('/users', function () {
    return view('users');
})->name('users');