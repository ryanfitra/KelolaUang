<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $pendaftar = User::where('role', 'peserta')->get();
        // $semester = Semester::orderBy('id_semester', 'desc')->get();

        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function generate($id)
    {
        $user = User::findOrFail($id);

        $noPeserta = date('Y') .'-'.str_pad($user->instansi_id, 2, '0', STR_PAD_LEFT).'-'.str_pad($user->posisi_id, 2, '0', STR_PAD_LEFT).'-'. str_pad($user->id, 4, '0', STR_PAD_LEFT);

        PesertaUjian::updateOrCreate(
            ['user_id' => $user->id],
            ['no_peserta' => $noPeserta],
            ['jenis_ujian_id' => 1]
        );

        return redirect()->back()->with('success', 'Nomor peserta berhasil digenerate: ' . $noPeserta);
    }

    public function generateAll()
    {
        $users = User::where('role', 'peserta')->get();

        foreach ($users as $user) {
            $noPeserta = date('Y') .'-'.str_pad($user->instansi_id, 2, '0', STR_PAD_LEFT).'-'.str_pad($user->posisi_id, 2, '0', STR_PAD_LEFT).'-'. str_pad($user->id, 4, '0', STR_PAD_LEFT);

            PesertaUjian::updateOrCreate(
            ['user_id' => $user->id],
            ['no_peserta' => $noPeserta],
            ['jenis_ujian_id' => 1]
        );
        }

        return redirect()->back()->with('success', 'Nomor peserta berhasil digenerate untuk semua pendaftar.');
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
