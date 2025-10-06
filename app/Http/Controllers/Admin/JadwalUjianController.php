<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisUjian;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\PesertaUjian;

class JadwalUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = JadwalUjian::with('jenisUjian', 'pesertaUjian', )->orderBy('id', 'ASC')->orderBy('sesi', 'ASC')->get();
        $jenisUjian = JenisUjian::get();

        // $peserta = PesertaUjian::with('jenisUjian')->get();
        // dd($data);
        // $semester = Semester::orderBy('id_semester', 'desc')->get();
        // dd($data);

        return view('admin.jadwal-ujian.index', compact('data', 'jenisUjian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_ujian_id'     => 'required|unique:jadwal_ujians,jenis_ujian_id',
            'sesi'               => 'required',
            'waktu_mulai_to'     => 'required|date',
            'waktu_selesai_to'   => 'required|date|after:waktu_mulai_to',
            'waktu_mulai_ujian'  => 'required|date',
            'waktu_selesai_ujian'=> 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman'   => 'required|date|after:waktu_selesai_ujian',
        ]);

        try {
            JadwalUjian::create([
                'jenis_ujian_id'     => $request->jenis_ujian_id,
                'sesi'               => $request->sesi,
                'waktu_mulai_to'     => $request->waktu_mulai_to,
                'waktu_selesai_to'   => $request->waktu_selesai_to,
                'waktu_mulai_ujian'  => $request->waktu_mulai_ujian,
                'waktu_selesai_ujian'=> $request->waktu_selesai_ujian,
                'waktu_pengumuman'   => $request->waktu_pengumuman,
            ]);

            return redirect()->route('admin.jadwal-ujian.index')
                            ->with('success', 'Jadwal ujian berhasil ditambahkan');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') { // duplicate / constraint violation
                return redirect()->back()->with('error', 'Jenis ujian tersebut sudah memiliki jadwal ujian.');
            }
            throw $e; // biarkan error lain ditangani Laravel
        }
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
            'jenis_ujian_id' => 'required|exists:jenis_ujians,id',
            'waktu_mulai_to' => 'required|date',
            'waktu_selesai_to' => 'required|date|after:waktu_mulai_to',
            'waktu_mulai_ujian' => 'required|date',
            'waktu_selesai_ujian' => 'required|date|after:waktu_mulai_ujian',
            'waktu_pengumuman' => 'required|date',
        ]);

        try {
            $jadwalUjian->update($validated);
            return redirect()->route('admin.jadwal-ujian.index')->with('success', 'Data berhasil diubah.');
        } catch (QueryException $e) {
            // Cek apakah error karena duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Jenis ujian ini sudah memiliki jadwal, silakan pilih jenis ujian lain.');
            }

            // Kalau error lain, lempar kembali
            throw $e;
        }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $jadwalUjian = JadwalUjian::findOrFail($id);

        // dd($jadwalUjian);
        if ($jadwalUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian tidak bisa dihapus karena sudah memiliki peserta.');
        }

        $jadwalUjian->delete();
        return redirect()->back()->with('success', 'Jadwal ujian berhasil dihapus.');
    }


}
