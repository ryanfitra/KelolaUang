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
use Maatwebsite\Excel\Facades\Excel;
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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $request->file('file')->getRealPath();
        $rows = \PhpOffice\PhpSpreadsheet\IOFactory::load($path)
                ->getActiveSheet()
                ->toArray();

        $instansiId = Auth::user()->instansi_id; // instansi sesuai user login
        $inserted = [];
        $skipped  = [];

        foreach (array_slice($rows, 1) as $row) {
            $namaJabatan = trim($row[0]);
            $keterangan  = $row[2] ?? null;

            if (empty($namaJabatan)) {
                continue; // skip baris kosong
            }

            // 🔎 Cek apakah jabatan sudah ada di instansi yang sama
            $exists = Jabatan::where('nama_jabatan', $namaJabatan)
                        ->where('instansi_id', $instansiId)
                        ->exists();

            if ($exists) {
                $skipped[] = $namaJabatan;
                continue; // lewati jika sudah ada
            }

            // Simpan jabatan baru
            Jabatan::create([
                'nama_jabatan' => $namaJabatan,
                'instansi_id'  => $instansiId,
                'keterangan'   => $keterangan,
            ]);

            $inserted[] = $namaJabatan;
        }

        return redirect()->back()->with([
            'success' => count($inserted) . ' jabatan berhasil ditambahkan',
            'warning' => count($skipped) > 0 
                            ? 'Beberapa jabatan dilewati karena sudah ada: ' . implode(', ', $skipped)
                            : null,
        ]);
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
