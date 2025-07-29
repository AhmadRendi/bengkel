<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Authentication;
use \App\Http\Controllers\InvoiceController;
use \App\Http\Controllers\AnalitikController;

// Route Tanpa Proteksi
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [Authentication::class, 'auth'])->name('login.auth');



Route::get('/logout', function (Request $request) {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


// Semua Route Setelah Login
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $controller = new DashboardController();
        $data = $controller->data();
        return view('admin.dashboard', compact('data'));
    })->name('dashboard');

    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [RegistrationController::class, 'register'])->name('register.store');

    Route::get('/products', function () {
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

    Route::get('/add-invoice', function () {
        $controller = new ProductController();
        $products = $controller->getAllProduct();
        return view('addInvoice', compact('products'));
    })->name('add-invoice');

    Route::get('/invoices', function () {
        $controller = new InvoiceController();
        $invoices = $controller->findAllInvoices();
        return view('invoices', compact('invoices'));
    })->name('invoices');

    Route::post('/add-invoice', [InvoiceController::class, 'store'])->name('invoice.store');

    Route::get('/invoice/preview/{id}', [InvoiceController::class, 'findInvoiceById'])->name('invoice.preview');

    Route::get('/invoice/{id}/download-pdf', [InvoiceController::class, 'downloadPdf'])->name('invoice.download.pdf');

    Route::get('/invoices/export-pdf-all', [InvoiceController::class, 'exportAllInvoicesPdf'])->name('invoices.export.pdf.all');

    Route::get('/invoices/{id}', [InvoiceController::class, 'showInvoiceDetail'])->name('invoices.show');

    Route::get('/find/user/{id}', [UserController::class, 'findUserById'])->name('find.user');

    Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user.reset.password');

    Route::get('/find/product/{id}', [ProductController::class, 'findProductById'])->name('find.product');

    Route::post('/update/user', [UserController::class, 'updateUser'])->name('update.user');

    Route::post('/update/product', [ProductController::class, 'update'])->name('update.product');

    Route::get('/analitik', [AnalitikController::class, 'analitik'])->name('analitik');
    Route::get('/analitik/export-pdf', [AnalitikController::class, 'exportAnalitikPdf'])->name('analitik.export.pdf');

    Route::post('delete/user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');

    Route::post('delete/product/{id}', [ProductController::class, 'destroy'])->name('delete.product');

    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

});
