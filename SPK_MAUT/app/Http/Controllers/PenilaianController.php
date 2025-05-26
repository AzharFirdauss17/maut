<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PenilaianController extends Controller
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
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])->get();
        return view('penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::with('subkriteria')->get();
        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        foreach ($request->nilai as $id_kriteria => $nilai) {
            Penilaian::updateOrCreate(
                ['id_alternatif' => $request->id_alternatif, 'id_kriteria' => $id_kriteria],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }
}