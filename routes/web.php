<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;


Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

Route::get('/logout', function () {
        return view('login');
    })->name('lagout');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/login', function () {
    return view('login');
})->name('login');