<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KriteriaController extends Controller
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
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria',
            'keterangan' => 'required',
            'bobot' => 'numeric|default:0',
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria,' . $kriteria->id_kriteria . ',id_kriteria',
            'keterangan' => 'required',
            'bobot' => 'numeric|default:0',
        ]);

        $kriteria->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }

    public function hitungBobotSemuaKriteria()
    {
        $kriteriaList = Kriteria::with('subkriteria')->get();
        $totalNilaiSemua = SubKriteria::sum('nilai');

        foreach ($kriteriaList as $kriteria) {
            $totalNilaiKriteria = $kriteria->subkriteria->sum('nilai');
            $bobot = $totalNilaiSemua > 0 ? $totalNilaiKriteria / $totalNilaiSemua : 0;

            $kriteria->bobot = $bobot;
            $kriteria->save();
        }

        return redirect()->back()->with('success', 'Bobot kriteria berhasil dihitung menggunakan metode MAUT.');
    }

}
