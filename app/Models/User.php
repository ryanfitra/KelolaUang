<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'nik',
        'warga_negara',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'alamat_kelurahan_desa',
        'kode_kelurahan_desa',
        'alamat_kecamatan',
        'kode_kecamatan',
        'alamat_kabupaten_kota',
        'kode_kabupaten_kota',
        'alamat_provinsi',
        'kode_provinsi',
        'agama',
        'no_wa',
        'wa_sender',
        'foto',
        'pendidikan_terakhir',
        'jurusan',
        'sekolah_universitas',
        'ijazah',
        'posisi_id',
        'posisi',
        'instansi_id',
        'tanggal_daftar',
        'email',
        'email_verified_at',
        'password',
        'role',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pesertaUjian()
    {
        return $this->hasMany(PesertaUjian::class, 'user_id', 'id');
    }
    
    public function instansi()
    {
        return $this->belongsTo(DaftarInstansi::class, 'instansi_id', 'id');
    }
}
