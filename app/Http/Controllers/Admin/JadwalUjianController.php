<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesertaUjian;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = JadwalUjian::with('jenisUjian', 'jenisUjian.pesertaUjian', )->get();
        $jenisUjian = JenisUjian::with('pesertaUjian')->get();

        // $peserta = PesertaUjian::with('jenisUjian')->get();
        // dd($data);
        // $semester = Semester::orderBy('id_semester', 'desc')->get();
        // dd($data);

        return view('admin.jadwal-ujian.index', compact('data', 'jenisUjian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_ujian_id' => 'required|unique:jadwal_ujians,jenis_ujian_id',
            'waktu_mulai_to' => 'required|date',
            'waktu_selesai_to' => 'required|date|after:waktu_mulai_to',
            'waktu_mulai_ujian' => 'required|date',
            'waktu_selesai_ujian' => 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman' => 'required|date|after:waktu_selesai_ujian',
        ]);

        JadwalUjian::create([
            'jenis_ujian_id' => $request->jenis_ujian_id,
            'waktu_mulai_to' => $request->waktu_mulai_to,
            'waktu_selesai_to' => $request->waktu_selesai_to,
            'waktu_mulai_ujian' => $request->waktu_mulai_ujian,
            'waktu_selesai_ujian' => $request->waktu_selesai_ujian,
            'waktu_pengumuman' => $request->waktu_pengumuman,
        ]);

        return redirect()->route('admin.jadwal-ujian.index')
                        ->with('success', 'Jadwal ujian berhasil ditambahkan');
    }


    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(JadwalUjian $jadwalUjian)
    {
        // Cek apakah sudah ada peserta ujian
        if ($jadwalUjian->jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian sudah memiliki peserta, tidak bisa diedit.');
        }

        $jenisUjian = JenisUjian::all();

        return view('admin.jadwal-ujian.edit', compact('jadwalUjian', 'jenisUjian'));
    }

    public function update(Request $request, JadwalUjian $jadwalUjian)
    {
        // Cek apakah sudah ada peserta ujian
        if ($jadwalUjian->jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian sudah memiliki peserta, tidak bisa diubah.');
        }

        $validated = $request->validate([
            'jenis_ujian_id' => 'required|exists:jenis_ujian,id',
            'waktu_mulai_to' => 'required|date',
            'waktu_selesai_to' => 'required|date|after:waktu_mulai_to',
            'waktu_mulai_ujian' => 'required|date',
            'waktu_selesai_ujian' => 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman' => 'required|date',
        ]);

        $jadwalUjian->update($validated);

        return redirect()->route('admin.jadwal-ujian.index')->with('success', 'Data berhasil diubah.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $jadwalUjian = JadwalUjian::findOrFail($id);

        // dd($jadwalUjian);
        if ($jadwalUjian->jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian tidak bisa dihapus karena sudah memiliki peserta.');
        }

        $jadwalUjian->delete();
        return redirect()->back()->with('success', 'Jadwal ujian berhasil dihapus.');
    }


}
