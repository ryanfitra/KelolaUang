<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jabatan;
use App\Models\JenisUjian;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPeserta = PesertaUjian::count();
        $jumlahJenisUjian = JenisUjian::count();
        $jumlahJabatan = Jabatan::count(); 
        // sesuaikan nama kolom status jika berbeda

        return view('admin.dashboard', compact('jumlahPeserta', 'jumlahJenisUjian', 'jumlahJabatan'));
    }
}
