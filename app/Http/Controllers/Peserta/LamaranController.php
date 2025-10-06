<?php

namespace App\Http\Controllers\Peserta;

use Carbon\Carbon;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JadwalUjian;
use App\Models\JenisUjian;
use Barryvdh\DomPDF\Facade\Pdf;
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

        // dd($data_peserta);

        $user_id = $data_peserta->id;

        $today = Carbon::now();

        // $today = Carbon::now()->format('d-m-Y H:i');
        

        $jadwal_ujian = JadwalUjian::with('jenisUjian')->get();
        $jenisUjian = JenisUjian::all();

        $detailPeserta = [
            'foto' => asset('storage/foto_peserta/'.$data_peserta->foto),
            'nama' => $data_peserta->nama,
            'posisi' => $data_peserta->posisi,
            'instansi' => $data_peserta->instansi,
        ];
        

        $detailPeserta['ujian'] = [];

        foreach ($data_peserta->pesertaUjian as $pesertaUjian) {
            $jadwal = $jadwal_ujian->where('id', $pesertaUjian->jenis_ujian_id)->first();

            // dd($today, $jadwal->waktu_mulai_to, $jadwal->waktu_selesai_to, $jadwal->waktu_selesai_ujian);
            if (!$jadwal) {
                continue;
            }

            // Tentukan status ujian
            if ($today < $jadwal->waktu_mulai_to) {
                $nama_ujian  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today >= $jadwal->waktu_mulai_to && $today <= $jadwal->waktu_selesai_to) {
                $nama_ujian  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today > $jadwal->waktu_selesai_to && $today <= $jadwal->waktu_selesai_ujian) {
                $nama_ujian  = $jadwal->jenisUjian->nama_ujian ?? '-';
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            } else {
                $nama_ujian  = 'Hasil ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            }

            $format_nama = strtoupper(str_replace(' ', '_', $detailPeserta['nama']));
// dd($detailPeserta['ujian']);
            $detailPeserta['ujian'][] = [
                'jenis_ujian_id' => $jadwal->jenis_ujian_id,
                'no_peserta'     => $pesertaUjian->no_peserta ?? '-',
                'nama_ujian'     => $nama_ujian,
                // 'foto'           => $data_peserta->foto ?? null,
                'mulai'          => Carbon::parse($mulai)->format('d-m-Y H:i'),
                'selesai'        => Carbon::parse($selesai)->format('d-m-Y H:i'),
                // tambahkan pengumuman & status ujian biar bisa difilter
                'pengumuman'     => Carbon::parse($jadwal->waktu_pengumuman)->format('d-m-Y H:i'),
                'status_ujian'     => $pesertaUjian->status_ujian ?? '-', 
                'format_nama'      => $format_nama,
            ];
        }

        dd($today, $data_peserta, $detailPeserta);

        // dd($detailPeserta['ujian'], $jadwal->waktu_mulai_to, $today, $data_peserta );

        


        return view('peserta.lamaran.index', [
            'data_peserta'=> $data_peserta,
            'detailPeserta' => $detailPeserta, 
            // 'ujiansToShow'  => $ujiansToShow, // 👈 kirim hasil filter ke view
            'today' => $today, 
            'jadwal_ujian' => $jadwal_ujian,
            'jenisUjian' => $jenisUjian
        ]);
    }


    public function downloadKartu($customId)
    {
    [$pesertaId, $noPeserta, $jenisUjianId] = explode('-', $customId);

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
                $nama_ujian  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today >= $jadwal->waktu_mulai_to && $today <= $jadwal->waktu_selesai_to) {
                // Sedang Try Out
                $nama_ujian  = 'Try Out ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_to;
                $selesai= $jadwal->waktu_selesai_to;
            } elseif ($today > $jadwal->waktu_selesai_to && $today <= $jadwal->waktu_selesai_ujian) {
                // Sedang ujian normal
                $nama_ujian  = $jadwal->jenisUjian->nama_ujian ?? '-';
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            } else {
                // Sudah selesai semua → bisa label "Hasil"
                $nama_ujian  = 'Hasil ' . ($jadwal->jenisUjian->nama_ujian ?? '-');
                $mulai  = $jadwal->waktu_mulai_ujian;
                $selesai= $jadwal->waktu_selesai_ujian;
            }

            $detailPeserta['ujian'][] = [
                'jenis_ujian_id' => $jadwal->jenis_ujian_id,
                'no_peserta'     => $pesertaUjian->no_peserta ?? '-',
                'nama_ujian'    => $nama_ujian,
                'foto'           => $data_peserta->foto ?? null,
                'waktu_mulai'    => \Carbon\Carbon::parse($mulai)->format('d-m-Y H:i'),
                'waktu_selesai'  => \Carbon\Carbon::parse($selesai)->format('d-m-Y H:i'),
            ];
        }

        $format_nama = strtoupper(str_replace(' ', '_', $detailPeserta['nama']));

        // dd($data_peserta, $detailPeserta, $detailPeserta['ujian']);

        // return view('peserta.lamaran.index', [
        //     'data_peserta'=> $data_peserta,
        //     'detailPeserta' => $detailPeserta, 
        //     'today' => $today, 
        //     'jadwal_ujian' => $jadwal_ujian,
        //     'jenisUjian' => $jenisUjian
        // ]);

        $pdf = Pdf::loadView('peserta.lamaran.download', 
        compact('data_peserta',
                'detailPeserta',
                'today',
                'jadwal_ujian',
                'jenisUjian'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('KARTU_PESERTA_'.$format_nama.'.pdf');
    }
}
