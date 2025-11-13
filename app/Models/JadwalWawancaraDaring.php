<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalWawancaraDaring extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_peserta',
        'jadwal_ujian_id',
        'waktu_mulai_wawancara',
        'waktu_selesai_wawancara',
        'link_wawancara',
    ];

    public function jadwalUjian()
    {
        return $this->belongsTo(JadwalUjian::class, 'jadwal_ujian_id');
    }
}
