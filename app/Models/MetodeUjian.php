<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeUjian extends Model
{
    use HasFactory;

    protected $fillable = ['nama_metode', 'deskripsi'];

    public function jadwalUjian()
    {
        return $this->hasMany(JadwalUjian::class, 'jadwal_ujian_id');
    }
}

