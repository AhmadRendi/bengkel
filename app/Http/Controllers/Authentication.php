<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Authentication extends Controller
{

    private $objectUser;

    public function __construct()
    {
        $this->objectUser = new User();
    }

    private function findUserByEmail(string $email): ?User
    {
        $user = $this->objectUser->findUserByEmail($email);
        if(!$user) {
            throw new \Exception('Email Tidak Ditemukan');
        }
        return $user;
    }

    private function validationPassword(string $plainPassword, $hashedPassword){
        if(!Hash::check($plainPassword, $hashedPassword)){
            throw new \Exception('Passwords Salah');
        }
        return;
    }

    public function auth(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required',
            ]);

            $creadentials = $request->only('email', 'password');

            $user = $this->findUserByEmail($request->input('email'));

            $this->validationPassword($creadentials['password'], $user->password);

            return redirect()->route('login')->with(['success' => 'Login Berhasil']);
        } catch (\Exception $e) {
            return redirect()->route('login')->with(['modal_error' => $e->getMessage()]);
        }
    }
}
