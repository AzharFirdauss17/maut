<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
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

    // Menampilkan halaman perhitungan
    public function index()
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();

        return view('Perhitungan.perhitungan', [
            'page' => "Perhitungan",
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
        ]);
    }

    // Menghitung hasil
    public function hasil()
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();

        // Hapus hasil sebelumnya
        Perhitungan::truncate(); // Ganti dengan logika hapus yang sesuai

        foreach ($alternatif as $key) {
            $nilai_total = 0;

            foreach ($kriteria as $k) {
                $data_pencocokan = Perhitungan::where('id_alternatif', $key->id_alternatif)
                                                ->where('id_kriteria', $k->id_kriteria)
                                                ->first();

                $min_max = $this->getMaxMin($k->id_kriteria); // Metode untuk mendapatkan min dan max
                $hasil_normalisasi = round(($data_pencocokan->nilai - $min_max['min']) / ($min_max['max'] - $min_max['min']), 4);
                $bobot = $k->bobot;
                $nilai_total += $bobot * $hasil_normalisasi;
            }

            $hasil_akhir = [
                'id_alternatif' => $key->id_alternatif,
                'nilai' => $nilai_total,
            ];
            Perhitungan::create($hasil_akhir);
        }

        $hasil = Perhitungan::all();

        return view('Perhitungan.hasil', [
            'page' => "Hasil",
            'hasil' => $hasil,
        ]);
    }

    // Mendapatkan nilai min dan max
    private function getMaxMin($id_kriteria)
    {
        // Implementasikan logika untuk mendapatkan nilai min dan max
        return [
            'min' => 0, // Ganti dengan logika yang sesuai
            'max' => 1, // Ganti dengan logika yang sesuai
        ];
    }
}