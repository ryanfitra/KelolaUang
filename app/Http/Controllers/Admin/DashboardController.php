<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use App\Models\JenisUjian;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLoginLog;

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

        // Ambil log login user dari tabel khusus (BUKAN sessions)
        $logs = UserLoginLog::with('user')
            ->select(
                'user_login_logs.*',
                DB::raw("(SELECT FROM_UNIXTIME(s.last_activity)
                        FROM sessions s 
                        WHERE s.user_id = user_login_logs.user_id
                        ORDER BY s.last_activity DESC
                        LIMIT 1
                        ) AS terakhir_aktif")
            )
            ->whereIn('user_login_logs.id', function($q) use ($adminInstansiId) {
                $q->select(DB::raw("MAX(user_login_logs.id)"))
                ->from('user_login_logs')
                ->join('users', 'users.id', '=', 'user_login_logs.user_id')
                ->where('users.instansi_id', $adminInstansiId)
                ->where('users.role', 'peserta')
                ->groupBy('user_login_logs.user_id');
            })
            ->orderByDesc('logged_in_at')
            ->get();

        return view('admin.dashboard', compact(
            'jumlahPeserta',
            'jumlahJenisUjian',
            'jumlahJabatan',
            'logs'
        ));
    }

}
