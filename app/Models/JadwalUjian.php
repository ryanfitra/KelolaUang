<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MetodeUjian;
use App\Models\JadwalWawancaraDaring;
use Illuminate\Database\Eloquent\Casts\Attribute;

class JadwalUjian extends Model
{
    protected $table = 'jadwal_ujians';

    protected $fillable = [
        'jenis_ujian_id',
        'sesi',
        'waktu_mulai_to',
        'waktu_selesai_to',
        'waktu_mulai_ujian',
        'waktu_selesai_ujian',
        'waktu_pengumuman',
    ];

    protected $casts = [
        'metode_ujian_id' => 'array',
    ];

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class, 'jenis_ujian_id', 'id');
    }

    public function pesertaUjian()
    {
        return $this->hasMany(PesertaUjian::class, 'jadwal_ujian_id');
    }

    public function metodeUjians()
    {
        // karena 'metode_ujian_id' disimpan dalam bentuk JSON
        // kita ambil manual dengan query whereIn
        return $this->belongsToMany(MetodeUjian::class, 'jadwal_ujians', 'id', 'metode_ujian_id');
    }

    public function getMetodeUjiansAttribute()
    {
        $ids = $this->metode_ujian_id ?? [];
        if (!is_array($ids)) {
            $ids = json_decode($ids, true) ?: [];
        }

        return MetodeUjian::whereIn('id', $ids)->get();
    }

    public function jadwalWawancaraDaring()
    {
        return $this->hasMany(JadwalWawancaraDaring::class, 'jadwal_ujian_id');
    }


}
