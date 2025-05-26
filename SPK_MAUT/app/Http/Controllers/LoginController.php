<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login pengguna
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect ke dashboard sesuai level user
            return redirect()->route('dashboard.index');
        }

        // Jika login gagal
        return back()->withErrors(['error' => 'Login gagal. Silakan periksa email dan password Anda.']);
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        Session::flash('message', 'Anda telah logout.');
        return redirect()->route('login');
    }
}