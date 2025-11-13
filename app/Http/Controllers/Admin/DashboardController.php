<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use App\Models\JenisUjian;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $adminInstansiId = Auth::user()->instansi_id;

        $jumlahPeserta = Auth::user()
                        ->where('instansi_id', $adminInstansiId)
                        ->where('role', 'peserta')
                        ->count();
        $jumlahJenisUjian = JenisUjian::count();
        $jumlahJabatan = Jabatan::count();

        // Ambil data sesi aktif dari tabel sessions yang sesuai instansi admin
        $sessions = DB::table('sessions as s')
            ->leftJoin('users as u', 'u.id', '=', 's.user_id')
            ->where('u.instansi_id', $adminInstansiId) // filter berdasarkan instansi
            ->whereNot('u.role','admin')
            ->select(
                's.id as session_id',
                'u.nama as nama_user',
                'u.email',
                's.ip_address',
                DB::raw('FROM_UNIXTIME(s.last_activity) as terakhir_aktif')
            )
            ->orderByDesc('s.last_activity')
            ->get();

        return view('admin.dashboard', compact(
            'jumlahPeserta',
            'jumlahJenisUjian',
            'jumlahJabatan',
            'sessions'
        ));
    }
}
