<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Debug: Log semua info user
        \Log::info("User mencoba akses admin:", [
            'email' => $user->email,
            'id_user_level' => $user->id_user_level ?? 'tidak ada',
            'user_level' => $user->user_level ?? 'tidak ada',
            'relasi_level' => optional($user->userLevel)->nama_level ?? 'tidak ada relasi'
        ]);

        // Cek level (sesuaikan sesuai struktur database kamu)
        $isAdmin = false;

        if ($user->user_level && strtolower($user->user_level) === 'admin') {
            $isAdmin = true;
        } elseif ($user->id_user_level == 1) {
            $isAdmin = true;
        } elseif ($user->userLevel && strtolower($user->userLevel->nama_level) === 'admin') {
            $isAdmin = true;
        }

        if ($isAdmin) {
            return $next($request);
        }

        // Jika tidak lolos, tolak akses
        \Log::warning("Akses ditolak untuk user: " . $user->email);
        return view('user.dashboard');
    }
}
