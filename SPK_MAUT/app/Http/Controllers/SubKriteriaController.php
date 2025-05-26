<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubKriteriaController extends Controller
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
        $subkriteria = SubKriteria::with('kriteria')->get();
        return view('subkriteria.index', compact('subkriteria'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriteria,id_kriteria',
            'deskripsi' => 'required|string',
            'nilai' => 'required|numeric'
        ]);

        SubKriteria::create($request->all());
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $kriteria = Kriteria::all();
        return view('subkriteria.edit', compact('subkriteria', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kriteria' => 'required|exists:kriteria,id_kriteria',
            'deskripsi' => 'required|string',
            'nilai' => 'required|numeric'
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update($request->all());
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil dihapus.');
    }
}