<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Level extends Model
{
    use HasFactory;


    protected $table = 'user_level';
    protected $primaryKey = 'id_user_level';
    protected $fillable = [
        'user_level'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_user_level');
    }
}
