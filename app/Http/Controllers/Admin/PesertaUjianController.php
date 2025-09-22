<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
// use App\Models\Semester;
use Illuminate\Http\Request;
// use App\Models\SemesterAktif;
// use App\Models\PenundaanBayar;
// use App\Models\Mahasiswa\LulusDo;
use App\Http\Controllers\Controller;
use App\Models\PesertaUjian;
use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\PenundaanBayarImport;
// use App\Models\Mahasiswa\RiwayatPendidikan;

class PesertaUjianController extends Controller
{
    public function index(Request $request)
    {
        $peserta = PesertaUjian::all();
        // dd($peserta);
        // $semester = Semester::orderBy('id_semester', 'desc')->get();

        return view('admin.peserta-ujian.index', compact('peserta'));
    }

    public function verifikasi(Request $request, $id)
    {
        $peserta = PesertaUjian::findOrFail($id);

        $request->validate([
            'status_ujian' => 'required|in:Lulus,Tidak Lulus, Belum Ujian,  Sedang Ujian',
        ]);

        // dd( $peserta);

        $peserta->update([
            'status_ujian' => $request->status_ujian, // "lolos" atau "gagal"
        ]);

        return redirect()->route('admin.peserta-ujian.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }

    // public function upload(Request $request)
    // {
    //     $data = $request->validate([
    //         'file' => 'required|mimes:xls,xlsx'
    //     ]);

    //     $file = $request->file('file');
    //     $import = Excel::import(new PenundaanBayarImport(), $file);

    //     return redirect()->back()->with('success', "Data successfully imported!");
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'id_registrasi_mahasiswa' => 'required|exists:riwayat_pendidikans,id_registrasi_mahasiswa',
    //         'status' => 'required|in:0,2,3,4,5',
    //         'keterangan' => 'nullable',
    //     ]);

    //     $check = LulusDo::where('id_registrasi_mahasiswa', $data['id_registrasi_mahasiswa'])->first();

    //     if ($check) {
    //         return redirect()->back()->with('error', 'Mahasiswa sudah ada pada data Lulus Do Feeder!!');
    //     }
    //     $data['id_semester'] = SemesterAktif::first()->id_semester;
    //     $data['nim'] = RiwayatPendidikan::where('id_registrasi_mahasiswa', $data['id_registrasi_mahasiswa'])->first()->nim;

    //     PenundaanBayar::create($data);

    //     return redirect()->back()->with('success', 'Data berhasil disimpan');
    // }

    // public function update(PenundaanBayar $penundaan, Request $request)
    // {
    //     $data = $request->validate([
    //         'status' => 'required|in:0,2,3,4,5',
    //         'keterangan' => 'nullable',
    //     ]);

    //     $restrict = ['4', '5'];
    //     if (in_array($penundaan->status, $restrict)) {
    //         return redirect()->back()->with('error', 'Data tidak bisa diubah');
    //     }

    //     $penundaan->update($data);

    //     return redirect()->back()->with('success', 'Data berhasil diubah');
    // }

    public function destroy(User $peserta)
    {
        // $peserta = User::findOrFail($id);
        $peserta->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

}
