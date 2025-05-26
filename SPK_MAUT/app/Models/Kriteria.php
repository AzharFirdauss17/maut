<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $fillable = [
        'keterangan',
        'kode_kriteria',
        'bobot'
    ];

    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_kriteria');
    }
    
    public function hitungBobot()
    {
        $totalSemuaSub = SubKriteria::sum(DB::raw('nilai'));

        if ($totalSemuaSub == 0) return 0;

        $totalKriteriaSub = $this->subkriteria()->sum('nilai');
        return $totalKriteriaSub / $totalSemuaSub;
    }

    
}