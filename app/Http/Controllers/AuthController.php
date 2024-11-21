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
            // Si las credenciales son correctas
            if (Auth::user()->role === 'admin') {
                // Si es un administrador, redirigir a los libros
                return response()->json(['success' => true, 'redirect' => route('books.index')]);
            }
            // Si es un usuario normal
            return response()->json(['success' => true, 'redirect' => route('home')]);
        }

        // Si las credenciales no coinciden
        return response()->json(['success' => false, 'message' => 'Las credenciales no coinciden con nuestros registros.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
