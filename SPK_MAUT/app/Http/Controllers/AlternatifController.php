<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AlternatifController extends Controller
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

    public function index()
    {
        $alternatif = Alternatif::all();
        return view('alternatif.index', compact('alternatif'));
    }

    public function create()
    {
        return view('alternatif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'departemen' => 'required',
            'email' => 'nullable|email',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
            'tahun' => 'required|integer',
            'keterangan' => 'nullable',
        ]);

        Alternatif::create($request->all());
        return redirect()->route('alternatif.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'departemen' => 'required',
            'email' => 'nullable|email',
            'no_telp' => 'nullable',
            'alamat' => 'nullable',
            'tahun' => 'required|integer',
            'keterangan' => 'nullable',
        ]);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->update($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Data berhasil diperbarui.');
    }
}
