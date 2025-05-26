<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
     Kriteria::insert([
            ['keterangan' => 'Status Kawin', 'kode_kriteria' => 'C1', 'bobot' => '0.10'],
            ['keterangan' => 'Jumlah Anak', 'kode_kriteria' => 'C2', 'bobot' => '0.05'],
            ['keterangan' => 'Status Tempat Tinggal', 'kode_kriteria' => 'C3', 'bobot' => '0.05'],
            ['keterangan' => 'Penghasilan / Pendapatan', 'kode_kriteria' => 'C4', 'bobot' => '0.20'],
            ['keterangan' => 'Jangka Waktu Pinjaman', 'kode_kriteria' => 'C5', 'bobot' => '0.10'],
            ['keterangan' => 'Lama Bekerja', 'kode_kriteria' => 'C6', 'bobot' => '0.15'],
            ['keterangan' => 'Riwayat Pinjaman', 'kode_kriteria' => 'C7', 'bobot' => '0.15'],
            ['keterangan' => 'Tanggungan', 'kode_kriteria' => 'C8', 'bobot' => '0.10'],
            ['keterangan' => 'Tujuan Pinjaman', 'kode_kriteria' => 'C9', 'bobot' => '0.10'],
        ]);

    }
}
