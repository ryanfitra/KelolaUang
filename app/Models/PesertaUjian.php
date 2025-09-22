<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujians';

    protected $fillable = [
        'user_id',
        'jenis_ujian_id',
        // 'jadwal_ujian_id',
        'no_peserta',
        'status_ujian',
        // tambahkan field lain yang boleh diisi mass assignment
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class, 'jenis_ujian_id', 'id');
    }

    public function jadwalUjian()
    {
        return $this->belongsTo(JadwalUjian::class, 'jadwal_ujian_id', 'id');
    }
}
