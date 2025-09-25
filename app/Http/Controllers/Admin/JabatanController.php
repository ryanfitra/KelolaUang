<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use App\Models\JenisUjian;
use App\Models\JadwalUjian;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Models\DaftarInstansi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = Jabatan::get();
        // dd($data);

        return view('admin.jabatan.index', compact('data'));
    }

    public function store(Request $request)
    {
         $instansi_id = Auth::user()->instansi_id;

        $request->validate([
            'nama_jabatan'     => 'required',
            // 'instansi_id'     => 'required|date',
            'keterangan'   => 'nullable',
        ]);

        try {
            Jabatan::create([
                'nama_jabatan'     => $request->nama_jabatan,
                'instansi_id'     => $instansi_id,
                'keterangan'   => $request->keterangan,
            ]);

            return redirect()->route('admin.jabatan.index')->with('success', 'Jabatan berhasil ditambahkan');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') { // duplicate / constraint violation
                return redirect()->back()->with('error', 'Nama Jabatan sudah ada pada Instansi anda!');
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

    // public function edit(Jabatan $jabatan)
    // {
    //     // Cek apakah sudah ada peserta ujian
    //     // if ($jadwalUjian->jenisUjian->pesertaUjian->count() > 0) {
    //     //     return redirect()->back()->with('error', 'Jadwal ujian sudah memiliki peserta, tidak bisa diedit.');
    //     // }

    //     $jenisUjian = JenisUjian::all();

    //     return view('admin.jabatan.edit', compact('jadwalUjian', 'jenisUjian'));
    // }

    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $request->validate([
            'nama_jabatan'     => 'required',
            // 'instansi_id'     => 'required|date',
            'keterangan'   => 'nullable',
        ]);



        try {
            $jabatan->update($validated);
            return redirect()->route('admin.jabatan.index')->with('success', 'Data berhasil diubah.');
        } catch (QueryException $e) {
            // Cek apakah error karena duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Nama Jabatan sudah ada pada Instansi anda!');
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
        
        $data = Jabatan::findOrFail($id);



        // dd($data, $id);
        // if ($data->jenisUjian->pesertaUjian->count() > 0) {
        //     return redirect()->back()->with('error', 'Jadwal ujian tidak bisa dihapus karena sudah memiliki peserta.');
        // }

        $data->delete();
        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }


}
