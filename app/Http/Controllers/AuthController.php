<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
         return view('auth.login');
    }

    public function  authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['string', 'email', 'required', 'max:255'],
            'password' => ['string', 'max:255']
        ]);


        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }
}
