<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisUjian;
use App\Models\JadwalUjian;
use App\Models\MetodeUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\PesertaUjian;
use Illuminate\Validation\Rule;

class JadwalUjianController extends Controller
{
    public function index()
    {
        $data = JadwalUjian::with(['jenisUjian', 'pesertaUjian', 'metodeUjians'])
            ->orderBy('id', 'ASC')
            ->orderBy('sesi', 'ASC')
            ->get();

        $jenisUjian = JenisUjian::get();
        $metodeUjian = MetodeUjian::get();

        return view('admin.jadwal-ujian.index', compact('data', 'jenisUjian', 'metodeUjian'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'jenis_ujian_id'     => [
                'required',
                Rule::unique('jadwal_ujians', 'jenis_ujian_id')->where(function ($q) use ($request) {
                    return $q->where('sesi', $request->sesi);
                }),
            ],
            'sesi'               => 'required',
            'waktu_mulai_to'     => 'nullable|date',
            'waktu_selesai_to'   => 'nullable|date|after:waktu_mulai_to',
            'waktu_mulai_ujian'  => 'required|date',
            'waktu_selesai_ujian'=> 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman'   => 'nullable|date|after:waktu_selesai_ujian',
        ]);

        try {
            $jadwal = JadwalUjian::create([
                'jenis_ujian_id'     => $request->jenis_ujian_id,
                'sesi'               => $request->sesi,
                'waktu_mulai_to'     => $request->waktu_mulai_to,
                'waktu_selesai_to'   => $request->waktu_selesai_to,
                'waktu_mulai_ujian'  => $request->waktu_mulai_ujian,
                'waktu_selesai_ujian'=> $request->waktu_selesai_ujian,
                'waktu_pengumuman'   => $request->waktu_pengumuman,
            ]);

            // Simpan metode ujian ke pivot
            $jadwal->metodeUjians()->attach($request->metode_ujians);

            return redirect()->route('admin.jadwal-ujian.index')
                ->with('success', 'Jadwal ujian berhasil ditambahkan.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'Jenis ujian tersebut sudah memiliki jadwal ujian.');
            }
            throw $e;
        }
    }

    public function edit(JadwalUjian $jadwalUjian)
    {
        $jenisUjian = JenisUjian::all();
        $metodeUjian = MetodeUjian::all();

        return view('admin.jadwal-ujian.edit', compact('jadwalUjian', 'jenisUjian', 'metodeUjian'));
    }

    public function update(Request $request, JadwalUjian $jadwalUjian)
    {
        $validated = $request->validate([
            'jenis_ujian_id' => [
                'required',
                Rule::unique('jadwal_ujians', 'jenis_ujian_id')
                    ->where(function ($q) use ($request) {
                        return $q->where('sesi', $request->sesi);
                    })
                    ->ignore($jadwalUjian->id),
            ],
            'sesi' => 'required',
            'waktu_mulai_to' => 'nullable|date',
            'waktu_selesai_to' => 'nullable|date|after:waktu_mulai_to',
            'waktu_mulai_ujian' => 'required|date',
            'waktu_selesai_ujian' => 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman' => 'nullable|date',
        ]);

        try {
            $jadwalUjian->update($validated);
            return redirect()->route('admin.jadwal-ujian.index')->with('success', 'Data berhasil diubah.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Jenis ujian ini sudah memiliki jadwal pada sesi tersebut.');
            }
            throw $e;
        }
    }


    public function destroy($id)
    {
        $jadwal = JadwalUjian::findOrFail($id);

        if ($jadwal->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian tidak bisa dihapus karena sudah memiliki peserta.');
        }

        // Hapus relasi pivot terlebih dahulu
        $jadwal->metodeUjians()->detach();
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal ujian berhasil dihapus.');
    }
}

