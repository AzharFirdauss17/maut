<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Penilaian;
use App\Models\LoanRequest;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanRequestController extends Controller
{
    // Tampilkan form pengajuan
    public function create()
    {
        $kriterias = Kriteria::with('subKriteria')->get();
        return view('loan.create', compact('kriterias'));
    }

    // Simpan pilihan penilaian dan hitung MAUT
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_dana' => 'required|numeric|min:10000',
            'jangka_waktu' => 'required|in:3,6,12',
            'pilihan' => 'required|array',
            'pilihan.*' => 'exists:sub_kriteria,id_sub_kriteria'
        ]);

        $userId = Auth::id();

        // Hapus penilaian lama jika ada
        Penilaian::where('id_user', $userId)->delete();

        foreach ($request->pilihan as $id_sub_kriteria) {
            Penilaian::create([
                'id_user' => $userId,
                'id_sub_kriteria' => $id_sub_kriteria
            ]);
        }

        // Hitung nilai MAUT
        $nilaiMaut = $this->hitungMAUT($userId);

        // Simpan ke loan_requests
        LoanRequest::updateOrCreate(
            ['id_user' => $userId],
            [
                'jumlah_dana' => $request->jumlah_dana,
                'jangka_waktu' => $request->jangka_waktu,
                'status' => $nilaiMaut >= 99 ? 'approved' : 'pending',
                'nilai_maut' => $nilaiMaut
            ]
        );

        return redirect()->route('loan.success')->with('success', 'Pengajuan pinjaman berhasil!');
    }

    // Fungsi hitung MAUT
    public function hitungMAUT($idUser)
    {
        $penilaian = Penilaian::where('id_user', $idUser)
            ->with(['subKriteria.kriteria'])
            ->get();

        $totalBobot = 0;
        $jumlahNilai = 0;

        foreach ($penilaian as $p) {
            $nilaiSub = (int)$p->subKriteria->nilai;
            $bobotKri = (float)$p->subKriteria->kriteria->bobot;

            $totalBobot += $bobotKri;
            $jumlahNilai += $nilaiSub * $bobotKri;
        }

        // Ambil data pinjaman terbaru
        $pinjaman = LoanRequest::where('id_user', $idUser)->first();
        if ($pinjaman && $pinjaman->jumlah_dana > 2000000) {
            // Jika dana besar, kurangi sedikit nilai MAUT
            $jumlahNilai *= 0.9;
        }

        if ($pinjaman && $pinjaman->jangka_waktu == 3) {
            // Jika jangka pendek, tambahkan risiko → kurangi nilai
            $jumlahNilai *= 0.85;
        }

        return $totalBobot > 0 ? round($jumlahNilai / $totalBobot, 2) : 0;
    }

    // Halaman sukses
    public function success()
    {
        return view('loan.success');
    }

  
    public function generatePDF($id)
    {
        $pinjaman = LoanRequest::with('user')->findOrFail($id);
        $penilaian = Penilaian::where('id_user', $pinjaman->id_user)
            ->with(['subKriteria.kriteria'])
            ->get();

        $data = [
            'pinjaman' => $pinjaman,
            'penilaian' => $penilaian,
        ];

        $pdf = Pdf::loadView('pdf.pinjaman', $data);
        return $pdf->download("pinjaman_{$id}.pdf");
    }
}