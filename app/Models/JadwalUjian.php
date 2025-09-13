<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    protected $fillable = [
        'jenis_ujian_id',
        'waktu_mulai_to',
        'waktu_selesai_to',
        'waktu_mulai_ujian',
        'waktu_selesai_ujian',
        'waktu_pengumuman',
    ];

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class, 'jenis_ujian_id', 'id');
    }
}
