<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria';
    protected $primaryKey = 'id_sub_kriteria';
    protected $fillable = [
        'id_kriteria',
        'deskripsi',
        'nilai'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function getNormalisasiAttribute()
    {
        $total = $this->kriteria->subkriteria()->sum('nilai');
        return $total > 0 ? $this->nilai / $total : 0;
    }

    
}