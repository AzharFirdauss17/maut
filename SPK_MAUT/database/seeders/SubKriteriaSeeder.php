<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SubKriteria;
class SubKriteriaSeeder extends Seeder
{
    public function run()
    {
        SubKriteria::insert([
            // C1: Status Kawin
            ['id_kriteria' => 1, 'deskripsi' => 'Kawin', 'nilai' => '100'],
            ['id_kriteria' => 1, 'deskripsi' => 'Belum Kawin', 'nilai' => '60'],

            // C2: Jumlah Anak
            ['id_kriteria' => 2, 'deskripsi' => '> 2 Anak', 'nilai' => '100'],
            ['id_kriteria' => 2, 'deskripsi' => '1-2 Anak', 'nilai' => '75'],
            ['id_kriteria' => 2, 'deskripsi' => 'Tidak Ada Anak', 'nilai' => '50'],

            // C3: Status Tempat Tinggal
            ['id_kriteria' => 3, 'deskripsi' => 'Milik Sendiri', 'nilai' => '100'],
            ['id_kriteria' => 3, 'deskripsi' => 'Kontrak/Sewa', 'nilai' => '60'],

            // C4: Penghasilan
            ['id_kriteria' => 4, 'deskripsi' => '> 5 Juta', 'nilai' => '100'],
            ['id_kriteria' => 4, 'deskripsi' => '3 - 5 Juta', 'nilai' => '80'],
            ['id_kriteria' => 4, 'deskripsi' => '< 3 Juta', 'nilai' => '60'],

            // C5: Jangka Waktu Pinjaman
            ['id_kriteria' => 5, 'deskripsi' => '3 Bulan', 'nilai' => '100'],
            ['id_kriteria' => 5, 'deskripsi' => '6 Bulan', 'nilai' => '75'],
            ['id_kriteria' => 5, 'deskripsi' => '12 Bulan', 'nilai' => '50'],

            // C6: Lama Bekerja
            ['id_kriteria' => 6, 'deskripsi' => '> 5 Tahun', 'nilai' => '100'],
            ['id_kriteria' => 6, 'deskripsi' => '3 - 5 Tahun', 'nilai' => '75'],
            ['id_kriteria' => 6, 'deskripsi' => '< 3 Tahun', 'nilai' => '50'],

            // C7: Riwayat Pinjaman
            ['id_kriteria' => 7, 'deskripsi' => 'Tidak Pernah Pinjam', 'nilai' => '100'],
            ['id_kriteria' => 7, 'deskripsi' => 'Pernah Pinjam & Lunas', 'nilai' => '80'],
            ['id_kriteria' => 7, 'deskripsi' => 'Pernah Pinjam & Masih Hutang', 'nilai' => '50'],

            // C8: Tanggungan
            ['id_kriteria' => 8, 'deskripsi' => '> 3 Orang', 'nilai' => '100'],
            ['id_kriteria' => 8, 'deskripsi' => '2 - 3 Orang', 'nilai' => '75'],
            ['id_kriteria' => 8, 'deskripsi' => '< 2 Orang', 'nilai' => '50'],

            // C9: Tujuan Pinjaman
            ['id_kriteria' => 9, 'deskripsi' => 'Pendidikan', 'nilai' => '100'],
            ['id_kriteria' => 9, 'deskripsi' => 'Kesehatan', 'nilai' => '90'],
            ['id_kriteria' => 9, 'deskripsi' => 'Rumah Tangga', 'nilai' => '80'],
            ['id_kriteria' => 9, 'deskripsi' => 'Konsumtif (Liburan, Gadget)', 'nilai' => '50'],
        ]);

    }
}