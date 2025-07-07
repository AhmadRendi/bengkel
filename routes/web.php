<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

Route::get('/pesanan', function () {
        return view('admin.pesanan');
    })->name('pesanan');