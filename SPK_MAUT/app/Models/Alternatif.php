<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = [
        'keterangan',
        'tahun',
        'nik',
        'nama',
        'jenis_kelamin',
        'departemen',
        'email',
        'no_telp',
        'alamat'
    ];

    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'id_alternatif');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }
}