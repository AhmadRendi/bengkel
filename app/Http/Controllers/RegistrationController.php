<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    private function validationPassword($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            throw new \Exception('Passwords do not match.');
        }
        if (strlen($password) < 8) {
            throw new \Exception('Password must be at least 8 characters long.');
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validationPassword($request->input('password'), $request->input('confirm_password'));

            $request->validate([
                'name' => 'required|string|max:25',
                'email' => 'required|string|email|max:50|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Create a new user instance
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            return redirect()->route('register')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            return redirect()->route('register')->with(['modal_error' => $e->getMessage()]);
        }

    }
}
