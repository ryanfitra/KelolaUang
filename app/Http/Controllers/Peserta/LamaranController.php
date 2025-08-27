<?php

namespace App\Http\Controllers\Peserta;

use Carbon\Carbon;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JadwalUjian;
use App\Models\JenisUjian;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

        $data_peserta = Auth::user()->load(
            'instansi',
            'pesertaUjian',
            'pesertaUjian.jadwalUjian',
            'pesertaUjian.jenisUjian'
        );

        $user_id = $data_peserta->id;

        $today = Carbon::now()->toDateTimeString();

        $jadwal_ujian = JadwalUjian::with('jenisUjian')->get();
        $jenisUjian = JenisUjian::all();

        $detailPeserta = [
            'foto' => asset('storage/foto_peserta/'.$data_peserta->foto),
            'nama' => $data_peserta->nama,
            'posisi' => $data_peserta->posisi,
            // $data_peserta->instansi,
            'instansi' => $data_peserta->instansi,
        ];

        $detailPeserta['ujian'] = [];

        foreach ($data_peserta->pesertaUjian as $pesertaUjian) {
            $jadwal = $jadwal_ujian->where('id', $pesertaUjian->jenis_ujian_id)->first();

            if (!$jadwal) {
                continue;
            }

            // Tentukan status ujian
            if ($today < $jadwal->waktu_mulai_to) {
                // Belum mulai Try Out
                $label  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today >= $jadwal->waktu_mulai_to && $today <= $jadwal->waktu_selesai_to) {
                // Sedang Try Out
                $label  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today > $jadwal->waktu_selesai_to && $today <= $jadwal->waktu_selesai_ujian) {
                // Sedang ujian normal
                $label  = $jadwal->jenisUjian->nama_ujian ?? '-';
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            } else {
                // Sudah selesai semua → bisa label "Hasil"
                $label  = 'Hasil ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            }

            $detailPeserta['ujian'][] = [
                'jenis_ujian_id' => $jadwal->jenis_ujian_id,
                'no_peserta'     => $pesertaUjian->no_peserta ?? '-',
                'jenis_ujian'    => $label,
                'foto'           => $data_peserta->foto ?? null,
                'waktu_mulai'    => \Carbon\Carbon::parse($mulai)->format('d-m-Y H:i'),
                'waktu_selesai'  => \Carbon\Carbon::parse($selesai)->format('d-m-Y H:i'),
            ];
        }


        // dd($data_peserta, $detailPeserta, $detailPeserta['ujian']);

        return view('peserta.lamaran.index', [
            'data_peserta'=> $data_peserta,
            'detailPeserta' => $detailPeserta, 
            'today' => $today, 
            'jadwal_ujian' => $jadwal_ujian,
            'jenisUjian' => $jenisUjian
        ]);
    }
}
