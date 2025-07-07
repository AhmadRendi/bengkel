<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->input('password') === "123" && $request->input('email') === "admin@gmail.com") {
            // Simulasikan login berhasil
            return redirect()->route('dashboard'); // pastikan route 'dashboard' tersedia
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }
}
