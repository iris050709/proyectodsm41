<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('books.index');
            }
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
