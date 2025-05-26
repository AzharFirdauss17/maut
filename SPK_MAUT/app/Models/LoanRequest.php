<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;

    protected $table = 'loan_requests';
    protected $primaryKey = 'id_loan_request';
    protected $fillable = ['id_user', 'jumlah_dana', 'jangka_waktu', 'status', 'nilai_maut'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id');
    }
}
