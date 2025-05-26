<!DOCTYPE html>
<html>
<head>
    <title>Detail Pinjaman - {{ $pinjaman->id_loan_request }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        h2 { color: #333; }
    </style>
</head>
<body>

    <h2>Laporan Hasil Perhitungan MAUT</h2>

    <p><strong>Nama Pegawai:</strong> {{ $pinjaman->user->nama }}</p>
    <p><strong>Email:</strong> {{ $pinjaman->user->email }}</p>
    <p><strong>Tanggal Pengajuan:</strong> {{ $pinjaman->created_at->format('d-m-Y H:i') }}</p>

    <h4>Detail Pinjaman</h4>
    <table>
        <tr><th>Jumlah Dana</th><td>Rp{{ number_format($pinjaman->jumlah_dana, 0, ',', '.') }}</td></tr>
        <tr><th>Jangka Waktu</th><td>{{ $pinjaman->jangka_waktu }} Bulan</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($pinjaman->status) }}</td></tr>
        <tr><th>Nilai MAUT</th><td>{{ $pinjaman->nilai_maut }}</td></tr>
    </table>

    <h4>Penilaian Kriteria</h4>
    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Sub-Kriteria</th>
                <th>Nilai</th>
                <th>Bobot</th>
                <th>Hasil (Nilai × Bobot)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penilaian as $p)
                <tr>
                    <td>{{ $p->subKriteria->kriteria->keterangan }}</td>
                    <td>{{ $p->subKriteria->deskripsi }}</td>
                    <td>{{ $p->subKriteria->nilai }}</td>
                    <td>{{ $p->subKriteria->kriteria->bobot }}</td>
                    <td>{{ (int)$p->subKriteria->nilai * (float)$p->subKriteria->kriteria->bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>