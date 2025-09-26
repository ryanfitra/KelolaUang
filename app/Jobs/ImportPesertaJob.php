<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ImportPesertaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $rows;
    protected $instansiId;
    protected $chunkIndex;

    public function __construct(array $rows, $instansiId, $chunkIndex)
    {
        $this->rows = $rows;
        $this->instansiId = $instansiId;
        $this->chunkIndex = $chunkIndex;
    }

    public function handle()
    {
        foreach ($this->rows as $index => $row) {
            if ($index == 0 && $this->chunkIndex == 0) {
                continue; // skip header di chunk pertama
            }

            try {
                $tanggal_lahir = $this->parseTanggal($row[5] ?? null);
                $password = $tanggal_lahir ? str_replace('-', '', $tanggal_lahir) : '12345678';

                User::create([
                    'nama' => isset($row[0]) ? strtoupper($row[0]) : null,
                    'nik' => $row[1] ?? null,
                    'warga_negara' => $row[2] ?? null,
                    'jenis_kelamin' => $row[3] ?? null,
                    'tempat_lahir' => isset($row[4]) ? strtoupper($row[4]) : null,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => isset($row[6]) ? strtoupper($row[6]) : null,
                    'alamat_kelurahan_desa' => isset($row[7]) ? strtoupper($row[7]) : null,
                    'kode_kelurahan_desa' => $row[8] ?? null,
                    'alamat_kecamatan' => isset($row[9]) ? strtoupper($row[9]) : null,
                    'kode_kecamatan' => $row[10] ?? null,
                    'alamat_kabupaten_kota' => isset($row[11]) ? strtoupper($row[11]) : null,
                    'kode_kabupaten_kota' => $row[12] ?? null,
                    'alamat_provinsi' => isset($row[13]) ? strtoupper($row[13]) : null,
                    'kode_provinsi' => $row[14] ?? null,
                    'agama' => $row[15] ?? null,
                    'no_wa' => $row[16] ?? null,
                    'wa_sender' => $row[17] ?? null,
                    'foto' => $row[18] ?? null,
                    'pendidikan_terakhir' => $row[19] ?? null,
                    'jurusan' => isset($row[20]) ? strtoupper($row[20]) : null,
                    'sekolah_universitas' => isset($row[21]) ? strtoupper($row[21]) : null,
                    'ijazah' => $row[22] ?? null,
                    'posisi_id' => $row[23] ?? null,
                    'posisi' => isset($row[24]) ? strtoupper($row[24]) : null,
                    'instansi_id' => $this->instansiId,
                    'tanggal_daftar' => $this->parseTanggal($row[25] ?? null),
                    'email' => $row[26] ?? null,
                    'password' => Hash::make($password),
                    'role' => $row[27] ?? 'peserta',
                ]);
            } catch (\Exception $e) {
                Log::error("Chunk {$this->chunkIndex}, Baris {$index} gagal: " . $e->getMessage());
            }
        }
    }

    private function parseTanggal($value)
    {
        if (!$value) return null;

        try {
            if (is_numeric($value)) {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
