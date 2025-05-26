<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanRequest;

class AdminController extends Controller
{
    // Daftar semua pinjaman
    public function index()
    {
        $pengajuan = LoanRequest::with('user')->get();
        return view('admin.pinjaman.index', compact('pengajuan'));
    }

    // ACC pinjaman
    public function acc($id)
    {
        $pinjaman = LoanRequest::findOrFail($id);
        if ($pinjaman->nilai_maut >= 60 && $pinjaman->status === 'pending') {
            $pinjaman->status = 'approved';
            $pinjaman->save();
            return back()->with('success', 'Pinjaman berhasil di-ACC.');
        } else {
            return back()->with('error', 'Pinjaman tidak memenuhi syarat untuk di-ACC.');
        }
    }

    // Tolak pinjaman
    public function reject($id)
    {
        $pinjaman = LoanRequest::findOrFail($id);
        if ($pinjaman->status === 'pending') {
            $pinjaman->status = 'rejected';
            $pinjaman->save();
            return back()->with('success', 'Pinjaman ditolak.');
        } else {
            return back()->with('error', 'Status pinjaman sudah berubah.');
        }
    }
}