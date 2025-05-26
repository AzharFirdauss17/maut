<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoanRequest;

class UserController extends Controller
{
    // app/Http/Controllers/UserController.php

    public function index()
    {
        $userId = Auth::id();
        $pinjaman = LoanRequest::where('id_user', $userId)->latest()->first();

        return view('user.dashboard', compact('pinjaman'));
    }

}