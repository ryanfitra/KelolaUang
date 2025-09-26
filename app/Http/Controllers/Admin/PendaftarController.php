<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            [
                'no_peserta' => $noPeserta,
                'jenis_ujian_id' => 1
            ]
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
                [
                    'no_peserta' => $noPeserta,
                    'jenis_ujian_id' => 1
                ]
            );
        }

        return redirect()->back()->with('success', 'Nomor peserta berhasil digenerate untuk semua pendaftar.');
    }


    public function upload(Request $request)
    {
        $instansiId = Auth::user()->instansi_id;
        
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $file = $request->file('file');

            // Baca Excel langsung tanpa make:import
            $rows = Excel::toArray([], $file);

            foreach ($rows[0] as $index => $row) {
                if ($index == 0) {
                    // Skip header
                    continue;
                }

                // Ambil nilai tanggal lahir dan jadikan password
                $tanggal_lahir = $row[5] ?? null; // kolom ke-6: tanggal_lahir (YYYY-MM-DD)
                $password = $tanggal_lahir ? str_replace('-', '', $tanggal_lahir) : '12345678';

                User::create([
                    'nama' => $row[0] ?? null,
                    'nik' => $row[1] ?? null,
                    'warga_negara' => $row[2] ?? null,
                    'jenis_kelamin' => $row[3] ?? null,
                    'tempat_lahir' => $row[4] ?? null,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $row[6] ?? null,
                    'alamat_kelurahan_desa' => $row[7] ?? null,
                    'kode_kelurahan_desa' => $row[8] ?? null,
                    'alamat_kecamatan' => $row[9] ?? null,
                    'kode_kecamatan' => $row[10] ?? null,
                    'alamat_kabupaten_kota' => $row[11] ?? null,
                    'kode_kabupaten_kota' => $row[12] ?? null,
                    'alamat_provinsi' => $row[13] ?? null,
                    'kode_provinsi' => $row[14] ?? null,
                    'agama' => $row[15] ?? null,
                    'no_wa' => $row[16] ?? null,
                    'wa_sender' => $row[17] ?? null,
                    'foto' => $row[18] ?? null,
                    'pendidikan_terakhir' => $row[19] ?? null,
                    'jurusan' => $row[20] ?? null,
                    'sekolah_universitas' => $row[21] ?? null,
                    'ijazah' => $row[22] ?? null,
                    'posisi_id' => $row[23] ?? null,
                    'posisi' => $row[24] ?? null,
                    'instansi_id' => $instansiId,
                    'tanggal_daftar' => $row[26] ?? null,
                    'email' => $row[27] ?? null,
                    'password' => Hash::make($password),
                    'role' => $row[29] ?? 'peserta',
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
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
