<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menampilkan dashboard berdasarkan level user
    public function index()
    {
        $user = Auth::user();

        switch ($user->id_user_level) {
            case 1:
                return redirect()->route('admin.dashboard'); // Admin
            case 2:
                return redirect()->route('user.dashboard'); // User
            default:
                return redirect()->route('login')->with('error', 'User level tidak dikenali.');
        }
    }
}