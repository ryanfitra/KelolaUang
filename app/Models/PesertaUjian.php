<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujians';

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
        return $this->belongsTo(JenisUjian::class, 'jenis_ujian_id', 'id');
    }
}

