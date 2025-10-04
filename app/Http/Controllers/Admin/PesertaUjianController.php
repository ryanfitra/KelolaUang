<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesertaUjian;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        try {
            $rows = Excel::toArray([], $file)[0]; // ambil sheet pertama
            $berhasil = 0;
            $gagal = [];

            // dd($rows);

            foreach ($rows as $index => $row) {
                if ($index == 0) continue; // lewati header

                try {
                    $no_peserta  = trim($row[0] ?? '');
                    $jenis_ujian_id = trim($row[1] ?? '');
                    $status_ujian   = trim($row[2] ?? '');

                    // dd($no_peserta, $jenis_ujian_id, $status_ujian);    

                    $check = PesertaUjian::where('no_peserta', $no_peserta)
                        ->where('jenis_ujian_id', $jenis_ujian_id)
                        ->first();

                    // dd($check);
                    if (!$no_peserta || !$jenis_ujian_id || !$status_ujian) {
                        $gagal[] = [
                            'baris' => $index + 1,
                            'no_peserta' => $no_peserta,
                            'jenis_ujian_id' => $jenis_ujian_id,
                            'status_ujian' => $status_ujian,
                            'keterangan' => 'Data tidak lengkap',
                        ];
                        continue;
                    }

                    $peserta = $update = PesertaUjian::where('no_peserta', $no_peserta)
                        ->where('jenis_ujian_id', $jenis_ujian_id)->first();

                    // dd($peserta);
                    if (!$peserta) {
                        $gagal[] = [
                            'baris' => $index + 1,
                            'no_peserta' => $no_peserta,
                            'jenis_ujian_id' => $jenis_ujian_id,
                            'status_ujian' => $status_ujian,
                            'keterangan' => 'Nomor peserta tidak ditemukan',
                        ];
                        continue;
                    }

                    // Update status ujian
                    $update = PesertaUjian::where('no_peserta', $no_peserta)
                        ->where('jenis_ujian_id', $jenis_ujian_id)
                        ->update(['status_ujian' => $status_ujian]);

                    if ($update) {
                        $berhasil++;
                    } else {
                        $gagal[] = [
                            'baris' => $index + 1,
                            'no_peserta' => $no_peserta,
                            'jenis_ujian_id' => $jenis_ujian_id,
                            'status_ujian' => $status_ujian,
                            'keterangan' => 'Peserta ujian tidak ditemukan',
                        ];
                    }
                } catch (\Exception $e) {
                    // tangani error per baris agar tidak hentikan seluruh proses
                    $gagal[] = [
                        'baris' => $index + 1,
                        'no_peserta' => $row[0] ?? '',
                        'jenis_ujian_id' => $row[1] ?? '',
                        'status_ujian' => $row[2] ?? '',
                        'keterangan' => 'Error: ' . $e->getMessage(),
                    ];
                    Log::error('Gagal import baris ' . ($index + 1) . ': ' . $e->getMessage());
                    continue;
                }
            }

            return redirect()->back()->with([
                'success' => "$berhasil data berhasil diperbarui.",
                'gagal' => $gagal
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }


    public function destroy(User $peserta)
    {
        // $peserta = User::findOrFail($id);
        $peserta->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

}
