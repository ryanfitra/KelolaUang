<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    protected $table = 'jenis_ujians';

    protected $fillable = [
        'nama_ujian',
        'deskripsi'
    ];

    // public function pesertaUjian()
    // {
    //     return $this->hasMany(PesertaUjian::class,'jenis_ujian_id', 'id' );
    // }

    public function jadwalUjian()
    {
        return $this->hasOne(JadwalUjian::class, 'jenis_ujian_id', 'id');
    }
}
