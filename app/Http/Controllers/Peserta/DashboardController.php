<?php

namespace App\Http\Controllers\Peserta;

use Carbon\Carbon;
use App\Models\Timeline;
use App\Models\JenisUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data peserta yang login
        $data_peserta = Auth::user()->load(
            'instansi',
            'pesertaUjian',
            'pesertaUjian.jadwalUjian',
            'pesertaUjian.jenisUjian'
        );

        $today = Carbon::now();

        // Ambil semua jadwal ujian
        $jadwal_ujian = JadwalUjian::with('jenisUjian')->get();
        $jenisUjian   = JenisUjian::all();

        // Detail peserta
        $detailPeserta = [
            'foto'     => $data_peserta->foto ? asset('storage/foto_peserta/'.$data_peserta->foto) : asset('images/default.jpg'),
            'nama'     => $data_peserta->nama,
            'posisi'   => $data_peserta->posisi,
            'instansi' => $data_peserta->instansi,
        ];

        $detailPeserta['ujian'] = [];

        foreach ($data_peserta->pesertaUjian as $pesertaUjian) {
            $jadwal = $jadwal_ujian->where('id', $pesertaUjian->jadwal_ujian_id)->first();

            if (!$jadwal) {
                continue;
            }

            // Tentukan status ujian
            if ($today < $jadwal->waktu_mulai_to) {
                $nama_ujian = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today >= $jadwal->waktu_mulai_to && $today <= $jadwal->waktu_selesai_to) {
                $nama_ujian = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today > $jadwal->waktu_selesai_to && $today <= $jadwal->waktu_selesai_ujian) {
                $nama_ujian = $jadwal->jenisUjian->nama_ujian ?? '-';
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            } else {
                $nama_ujian = 'Hasil ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            }

            $detailPeserta['ujian'][] = [
                'jenis_ujian_id' => $jadwal->jenis_ujian_id,
                'no_peserta'     => $pesertaUjian->no_peserta ?? '-',
                'nama_ujian'     => $nama_ujian,
                'foto'           => $data_peserta->foto ?? null,
                'status_ujian'   => $pesertaUjian->status_ujian ?? null,
                'waktu_mulai'    => Carbon::parse($mulai)->format('d-m-Y H:i'),
                'waktu_selesai'  => Carbon::parse($selesai)->format('d-m-Y H:i'),
            ];
        }

        $timelines = Timeline::where('instansi_id', $data_peserta->instansi_id )->orderBy('id')->get();

        // dd($timelines);

        // Kirim ke view dashboard peserta
        return view('peserta.dashboard', [
            'data_peserta'  => $data_peserta,
            'detailPeserta' => $detailPeserta,
            'today'         => $today,
            'jadwal_ujian'  => $jadwal_ujian,
            'jenisUjian'    => $jenisUjian,
            'timelines'     => $timelines
        ]);
    }
}
