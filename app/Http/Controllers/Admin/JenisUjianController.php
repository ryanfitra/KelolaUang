<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisUjian;
use Illuminate\Http\Request;

class JenisUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisUjian::get();
        // $semester = Semester::orderBy('id_semester', 'desc')->get();

        return view('admin.jenis-ujian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_ujian' => 'required',
            'deskripsi' => 'required',
        ]);

        JenisUjian::create([
            'nama_ujian' => $request->jenis_ujian,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.jenis-ujian.index')
                        ->with('success', 'Jenis ujian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisUjian $jenisUjian)
    {
        // Cek apakah sudah ada peserta ujian
        if ($jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian sudah memiliki peserta, tidak bisa diedit.');
        }

        return view('admin.jadwal-ujian.edit', compact('jenisUjian'));
    }

    public function update(Request $request, JenisUjian $jenisUjian)
    {
        // Cek apakah sudah ada peserta ujian
        if ($jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jadwal ujian sudah memiliki peserta, tidak bisa diubah.');
        }

        $validated = $request->validate([
            'nama_ujian' => 'required',
            'deskripsi' => 'required',
        ]);

        $jenisUjian->update($validated);

        // dd($jenisUjian);

        return redirect()->route('admin.jenis-ujian.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $jenisUjian = JenisUjian::findOrFail($id);

        // dd($jadwalUjian);
        if ($jenisUjian->pesertaUjian->count() > 0) {
            return redirect()->back()->with('error', 'Jenis ujian tidak bisa dihapus karena sudah memiliki peserta.');
        }

        $jenisUjian->delete();
        return redirect()->back()->with('success', 'Jenis ujian berhasil dihapus.');
    }
}
