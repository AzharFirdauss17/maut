<?php

namespace App\Http\Controllers;

use App\Models\User_Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserLevelController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth'); // Pastikan user sudah login

        // Cek level user
        $this->middleware(function ($request, $next) {
            if (Auth::user()->id_user_level != 1) {
                return redirect()->route('login')->with('error', 'Anda tidak berhak mengakses halaman ini!');
            }
            return $next($request);
        });
    }
    
    // Menampilkan daftar user level
    public function index()
    {
        $userLevels = User_Level::all();
        return view('user_level.index', compact('userLevels'));
    }

    // Menampilkan form untuk membuat user level baru
    public function create()
    {
        return view('user_level.create');
    }

    // Menyimpan user level baru
    public function store(Request $request)
    {
        $request->validate([
            'user_level' => 'required|string|max:255',
        ]);

        User_Level::create($request->all());
        Session::flash('message', 'User level berhasil disimpan!');

        return redirect()->route('user_level.index');
    }

    // Menampilkan form untuk mengedit user level
    public function edit($id)
    {
        $userLevel = User_Level::findOrFail($id);
        return view('user_level.edit', compact('userLevel'));
    }

    // Memperbarui user level
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_level' => 'required|string|max:255',
        ]);

        $userLevel = User_Level::findOrFail($id);
        $userLevel->update($request->all());
        Session::flash('message', 'User level berhasil diupdate!');

        return redirect()->route('user_level.index');
    }

    // Menghapus user level
    public function destroy($id)
    {
        $userLevel = User_Level::findOrFail($id);
        $userLevel->delete();
        Session::flash('message', 'User level berhasil dihapus!');

        return redirect()->route('user_level.index');
    }
}