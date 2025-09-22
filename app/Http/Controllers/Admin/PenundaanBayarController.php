<?php

namespace App\Http\Controllers\Universitas;

use App\Models\User;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\SemesterAktif;
use App\Models\PenundaanBayar;
use App\Models\Mahasiswa\LulusDo;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PenundaanBayarImport;
use App\Models\Mahasiswa\RiwayatPendidikan;

class PenundaanBayarController extends Controller
{
    public function index(Request $request)
    {
        $peserta = User::with(['semester', 'riwayat'])->filter($request)->get();
        // $semester = Semester::orderBy('id_semester', 'desc')->get();

        return view('admin.peserta.index', compact('peserta'));
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

    // public function destroy(PenundaanBayar $penundaan)
    // {
    //     $restrict = ['4', '5'];
    //     if (in_array($penundaan->status, $restrict)) {
    //         return redirect()->back()->with('error', 'Data tidak bisa dihapus');
    //     }
    //     $penundaan->delete();

    //     return redirect()->back()->with('success', 'Data berhasil dihapus');
    // }
}
